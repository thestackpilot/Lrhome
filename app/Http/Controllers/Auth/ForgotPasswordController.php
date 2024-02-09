<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Mail\SendMail;
use App\Http\Controllers\ApisController;
use Validator;

class ForgotPasswordController extends AuthController
{
    // extends RootController
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    // use SendsPasswordResetEmails;

    public function __construct()
    {
        parent::__construct();
        // $this->middleware( 'guest' )->except( 'logout' );
        $this->ApiObj = new ApisController();
        $this->model  = new User();
    }

    public function show_forget_password()
    {
        return view('frontend.'.$this -> active_theme -> theme_abrv.'.forgetpassword');
    }

    public function submit_forget_password( Request $request )
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|exists:users'
        ]);

        if($validator->fails())
        {
            $response = $this->ApiObj->ForgotPassword( $request->email );
            if($response['Success'])
            {
                
                $user = DB::table('users')->where(['customer_id' => $response['UserID']])->first();
                if($user)
                {
                    $data = [
                        'email'   => $response['EmailAddress'],
                        'updated_at' => date( 'Y-m-d H:i:s' )
                    ];
                    DB::table('users')->where( ['customer_id' => $response['UserID']] )->update($data);
                }
                else
                {
                    $data = [
                        'email'          => $response['EmailAddress'] ? $response['EmailAddress'] : null,
                        'password'       => Hash::make( $response['Password'] ),
                        'customer_id'    => $response['UserID'],
                        'is_active'      => 1,
                    ];
                    $this->model->add_user( $data );
                }
                
            }
            else {
                return back()->with('message', $response['Message']);
            }

        }

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        try {
            Mail::send('email.forgetpassword', ['token' => $token], function ($message) use ($request) {
                $message->to($request->email);
                $message->subject('Reset Password');
            });
        }
        catch(\Exception $e){
            prr("Mail Exception: " . $e->getMessage());
        }

        return back()->with('message', isset($response['Message']) && $response['Message'] ? $response['Message'] : 'We have E-mailed your password reset link.');
        
    }

    public function show_reset_password( $token )
    {
        $user = DB::table('password_resets')->where(['token' => $token])->first();

        if($user)
        {
            return view('frontend.'.$this -> active_theme -> theme_abrv.'.forgetpasswordlink', ['token' => $token, 'email' => $user->email]);
        }
        else
        {
            return redirect()->route('forget.password.get')->withInput()->with( 'message', 'Password token expired/invalid.' );
        }
    }

    public function submit_reset_password( Request $request )
    {
        $validated_data = $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8'
        ]);

        $updatePassword = DB::table('password_resets')
            ->where([
                'email' => $request->email,
                'token' => $request->token
            ])
            ->first();

        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        $user = $this->model->get_user( 'email', $validated_data['email'] );

        if ( $user->parent_id === NULL )
        {
            // update password in the API
            $response = $this->ApiObj->ResetPassword( $user->customer_id, $validated_data['password'], '', $validated_data['confirm_password'] );

            if ( $response['Success'] )
            {
                DB::table('password_resets')->where(['email' => $validated_data['email']])->delete();

                return redirect()->route('auth.login')->withInput()->with( 'message', [ 'type' => 'success', 'referer' => 'login', 'body' => 'Password has been changed successfully.' ] );
            }
            else
            {
                return redirect()->back()->withInput()->with( 'message', [ 'type' => 'danger', 'referer' => 'login', 'body' => $response['Message'] ] );
            }
        }
        else
        {
            // update password in the DB
            DB::table('password_resets')->where(['email' => $validated_data['email']])->delete();
            $this->model->update_user( ['password' => Hash::make($validated_data['password'])], $user->id );

            return redirect()->route('auth.login')->withInput()->with( 'message', [ 'type' => 'success', 'referer' => 'login', 'body' => 'Password has been changed successfully.' ] );
        }

    }

}
