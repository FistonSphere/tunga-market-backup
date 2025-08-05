<?php

namespace App\Mail;

use App\Models\ContactRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactRequestConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    public function __construct(ContactRequest $contact)
    {
        $this->contact = $contact;
    }

    public function build()
    {
        return $this->subject('We Received Your Inquiry')
            ->view('emails.auth.contact-user');
    }
}
