<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($pendingUser)
    {
        $this->user = $pendingUser;
    }

    public function build()
    {
        return $this->subject('Your Tunga Market OTP Code')
            ->view('emails.auth.otp')
            ->with('user', $this->user);
    }
}
