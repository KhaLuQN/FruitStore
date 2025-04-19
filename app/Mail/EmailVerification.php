<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EmailVerification extends Mailable
{
    use Queueable, SerializesModels;

    public $verificationUrl;

    /**
     * Create a new message instance.
     *
     * @param  string  $verificationToken
     * @return void
     */
    public function __construct($verificationToken)
    {
        $this->verificationUrl = url("/email/verify/{$verificationToken}");
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('auth.emails.verify')
            ->subject('Xác thực email của bạn');
    }
}
