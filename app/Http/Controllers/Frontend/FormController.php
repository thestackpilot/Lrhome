<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Form;
use App\Jobs\SendMail;
use App\Models\FormEntries;
use Illuminate\Http\Request;
use App\Http\Controllers\CommonController;
use App\Http\Controllers\ConstantsController;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Session;
use ReCaptcha\ReCaptcha;
use MeWebStudio\Captcha\Facades\Captcha;
class FormController extends FrontendController
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Display the landing page of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( $slug )
    {
        $this->append_breadcrumbs( ucfirst( $slug ), route( 'form.show', [$slug] ) );

        return view( 'frontend.'.$this->active_theme->theme_abrv.'.'.( $slug ) );
    }

    public function store( Request $request, $slug )
    {
        $dataArray = $request->all();
        //prr($dataArray);
        $dataToSave = [
            'name'    => $dataArray['fullname'],
            'email'   => $dataArray['email'],
            'company' => $dataArray['company'],
            'phone'   => $dataArray['phone'],
            'details' => $dataArray['Inquiry']
        ];

        if ( Auth::user() )
        {
            $dataToSave['customer_id'] = Auth::user()->customer_id;
        }

        $response = ContactUs::insert( $dataToSave );

        if ( $response == 1 )
        {
            return back()->with( 'success', 'We have received your Inquiry request, We will contact you soon' );
        }
        else
        {
            return back()->with( 'error', 'Something is going wrong while processing you request' );
        }

    }

    public function submission_request( Request $request, $slug )
    {
// dd($request->all());
// dd($slug);
Session::start();
// dd(session()->all());


        if ( $request->all() )
        {
            // Basic validation and allowlisting of common fields
            $validated = $request->validate( [
                'email'           => 'nullable|email:rfc,dns|max:255',
                'business_email'  => 'nullable|email:rfc,dns|max:255',
                'name'            => 'nullable|string|max:255',
                'company'         => 'nullable|string|max:255',
                'phone'           => 'nullable|string|max:50',
                'city'            => 'nullable|string|max:255',
                'Inquiry'         => 'nullable|string|max:5000',
                'message'         => 'nullable|string|max:5000',
                'attachment'      => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120'
            ] );

            if ($slug == 'contact_us') {
                $validated = $request->validate([
                    'captcha_contact' => 'captcha',
                ]);
            } else if ($slug == 'newsletter') {
                $validated = $request->validate([
                    'captcha_newsletter' => 'captcha',
                ]);
            } else if ($slug == 'partner_requests') {
                $validated = $request->validate([
                    'captcha_partner' => 'captcha',
                ]);
            }

            $data = $request->all();

            if ( $request->hasFile( 'attachment' ) && $request->file( 'attachment' )->isValid() )
            {
                $data['attachment'] = CommonController::upload_file_ftp( $request->attachment ); //  $request->attachment->store( 'storage' )
            }

            if ( isset( $data['g-recaptcha-response'] ) && $data['g-recaptcha-response'] )
            {
		 // Log captcha information
                $captchaSiteKey = config('services.recaptcha.key');
                $captchaResponse = $data['g-recaptcha-response'];
                
                Log::info('Captcha Information', [
                    'captcha_site_key_on_screen' => $captchaSiteKey,
                    'captcha_response_in_request' => $captchaResponse,
                    'form_slug' => $slug,
                    'ip_address' => $request->ip()
                ]);
                // $recaptcha = new \ReCaptcha\ReCaptcha(env('GOOGLE_RECAPTCHA_SECRET'));
                // $response = $recaptcha->verify($data['g-recaptcha-response'], $request->ip());
                // if ($response->isSuccess() && $response->getScore() <= 0.5) return redirect()->back();
                unset( $data['g-recaptcha-response'] );
            }

            // Simple bot traps retained
            if ( isset( $data['company'] ) && $data['company'] === 'google' ) return redirect()->back();
            if ( isset( $data['name'] ) && $data['name'] === 'Robertsed' ) return redirect()->back();
            if ( isset( $data['city'] ) && $data['city'] === 'Mtskheta' ) return redirect()->back();

            // Sanitize all scalar string inputs to reduce payload risks when stored/emailed
            foreach ( $data as $key => $value )
            {
                if ( is_string( $value ) )
                {
                    $clean = trim( strip_tags( $value ) );
                    $clean = filter_var( $clean, FILTER_UNSAFE_RAW, [ 'flags' => FILTER_FLAG_STRIP_LOW ] );
                    // Bound extremely long inputs
                    if ( strlen( $clean ) > 10000 )
                    {
                        $clean = substr( $clean, 0, 10000 );
                    }
                    $data[$key] = $clean;
                }
            }

            $form                = Form::where( 'slug', $slug )->firstOrFail();
            $form_entry          = new FormEntries();
            $form_entry->form_id = $form->id;
            $form_entry->data    = json_encode( $data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
            $form_entry->save();

            if ( isset( $this->active_theme_json->general->allow_emails ) && $this->active_theme_json->general->allow_emails )
            {
                try {
                    if ( $slug == 'partner_requests' || $slug == 'contact_us')
                    {
                        SendMail::dispatch( [
                            'data'     => $data,
                            'slug'     => ucwords( str_replace( '_', ' ', $slug ) ),
                            'email'    => ConstantsController::ADMIN_EMAIL, //["qudsiaa.ziaa@gmail.com", "techbugs06@gmail.com"], 
                            'template' => 'email.email'
                        ] );
                    }

                }
                catch ( \Exception $e )
                {
                    prr( "Mail Exception: ".$e->getMessage() );
                }

                try {

                    if ( $this->active_theme->theme_abrv == 'LR' && ( isset( $data['email'] ) && $data['email'] ) || ( isset( $data['business_email'] ) && $data['business_email'] ) )
                    {
                        $to_email = ( isset( $data['email'] ) ? $data['email'] : $data['business_email'] );

                        SendMail::dispatch( [
                            'slug'  => 'Thank You!',
                            'email' => $to_email,
                            'body'  => 'Thanks for reaching out to us, our team will be in touch with you soon.'
                        ] );
                    }

                }
                catch ( \Exception $e )
                {
                    prr( "Thank You Mail Exception: ".$e->getMessage() );
                }

            }

            return redirect()->back()->with( 'message', ['type' => 'success', 'referrer' => $slug, 'body' => $slug == 'newsletter' ? 'Thanks for subscribing!' : 'Thanks for filling out the form. Our team will be in touch with you soon.'] );
        }

        return redirect()->back()->with( 'message', ['type' => 'success', 'referrer' => $slug, 'body' => 'Thanks for filling out the form. Our team will be in touch with you soon.'] );
    }

}
