<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $token;

    public string $resetPasswordUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(string $token, string $resetPasswordUrl)
    {
        $this->token = $token;
        $this->resetPasswordUrl = $resetPasswordUrl;
    }

    public function build(): ResetPasswordMail
    {
        return $this->subject('Reset Password Notification')
            ->view('emails.reset_password');
    }
}
