<?php

namespace App\Notifications;

use Illuminate\Mail\Mailable;

class OtpRegistrationMail extends Mailable
{
    public $otp;
    public $name;

    public function __construct($otp, $name)
    {
        $this->otp = $otp;
        $this->name = $name;
    }

    public function build()
    {
        return $this->subject('Verify Your Account')
            ->view('emails.auth.otp');
    }
}

