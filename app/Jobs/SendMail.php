<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail as MailSendMail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Http\Controllers\ConstantsController;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( $details )
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        prr( " :: In handle() :: " );
        try {

            if ( env('APP_ENV') != 'live' && env('APP_ENV') && 'production' && env('APP_ENV') != 'prod' )
            {
                $this->details['email'] = isset($this->details['email']) && $this->details['email'] ? ConstantsController::TEST_EMAIL : '';
                $this->details['cc_email'] = isset($this->details['cc_email']) && $this->details['cc_email'] ? ConstantsController::TEST_EMAIL : '';
            }
            
            prr( ['DETAILS' => $this->details] );

            if( isset($this->details['cc_email']) && $this->details['cc_email'] )
            {
                Mail::to( $this->details['email'] )->cc( $this->details['cc_email'] )->send( new MailSendMail( $this->details['data'], $this->details['slug'], $this->details['template'] ) );
            }
            else
            {
                if ( isset( $this->details['template'] ) && $this->details['template'] && isset( $this->details['data'] ) && $this->details['data'] )
                {
                    Mail::to( $this->details['email'] )->send( new MailSendMail( $this->details['data'], $this->details['slug'], $this->details['template'] ) );
                }
                else
                {
                    $to_email = $this->details['email'];
                    Mail::send( [], [], function ( $message ) use ( $to_email )
                    {
                        $message->to( $to_email )->subject( $this->details['slug'] )->setBody( $this->details['body'] );
                    } );
                }
            }

            prr( " :: Mail Sent :: " );
        }
        catch ( \Exception $e )
        {
            prr( ['SendMail::Exception' => $e->getMessage()] );
            sleep( rand( 1, 3 ) );
            dispatch( new static( [
                'email'    => $this->details['email'],
                'data'     => $this->details['data'],
                'slug'     => $this->details['slug'],
                'template' => $this->details['template']
            ] ) );
            sleep( rand( 1, 3 ) );
        }
        catch ( \Error $e )
        {
            prr( ['SendMail::Error' => $e->getMessage()] );
            sleep( rand( 1, 3 ) );
            dispatch( new static( [
                'data'     => $this->details['data'],
                'slug'     => $this->details['slug'],
                'template' => $this->details['template']
            ] ) );
        }

    }

}
