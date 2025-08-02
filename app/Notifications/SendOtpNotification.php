<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;

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
    // Send manually using Mailable, not MailMessage
    Mail::to($notifiable->email)->send(new OtpMail($this->otp, $this->user));

    // Return a basic MailMessage just for Notification system compatibility (won’t be used)
    return (new \Illuminate\Notifications\Messages\MailMessage)
        ->line('OTP email sent via custom template.');
}
}
