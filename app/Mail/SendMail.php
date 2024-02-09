<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public $slug;

    public $template;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $data, $slug, $template = '' )
    {
        $this->data     = $data;
        $this->slug     = $slug;
        $this->template = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        if ( isset( $this->data['attachment'] ) && $this->data['attachment'] )
        {
            return $this->subject( $this->slug )->attach( $this->data['attachment'] )->view( $this->template ? $this->template : 'email.email' );
        }
        else
        {
            return $this->subject( $this->slug )->view( $this->template ? $this->template : 'email.email' );
        }

    }

}
