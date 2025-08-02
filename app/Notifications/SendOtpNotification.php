<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class SendOtpNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $otp;
    protected $user;

    public function __construct($otp, $user)
    {
        $this->otp = $otp;
        $this->user = $user;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Tunga Market – Verify Your Account')
            ->greeting("Hello {$this->user},")
            ->line("Thank you for registering on **Tunga Market**.")
            ->line("Please use the following **OTP code** to verify your email address:")
            ->line("🔐 **{$this->otp}**")
            ->line("This code will expire in 1 hour.")
            ->action('Visit Tunga Market', url('/'))
            ->line('If you did not request this, please ignore this email.')
            ->view('emails.auth.otp', [
                'otp' => $this->otp,
                'user' => $this->user
            ]);
    }
}
