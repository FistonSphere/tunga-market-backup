<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class AdminSupportController extends Controller
{
  public function index(){
     $contacts = ContactRequest::latest()->paginate(10);
        return view('admin.support.contact-request', compact('contacts'));
  }


  public function show(ContactRequest $contact)
    {
        return view('admin.support.show-contact-request', compact('contact'));
    }

    public function reply(Request $request, ContactRequest $contact)
    {
            $validated = $request->validate([
        'contact_id' => 'required|exists:contact_requests,id',
        'reply_message' => 'required|string|max:2000',
        'status' => 'required|in:Pending,In Progress,Resolved',
    ]);

    $contact = ContactRequest::findOrFail($validated['contact_id']);

    $subject = 'Reply to your contact request';
    $messageText = $validated['reply_message'];

        /**
         * =====================
         * ✉️ EMAIL SENDING
         * =====================
         */
        try {
            $emailContent = view('emails.reply_contact', [
                'contact' => $contact,
                'messageText' => $messageText,
            ])->render();

            Mail::send([], [], function ($message) use ($contact, $subject, $emailContent) {
                $message->to($contact->email)
                    ->subject($subject)
                    ->html($emailContent);
            });

            Log::info("✅ Contact email sent successfully to {$contact->email}");
        } catch (\Exception $e) {
            Log::error("❌ Failed to send email to contact: " . $e->getMessage());
        }

        /**
         * =====================
         * 📱 SMS SENDING (MISTA.IO)
         * =====================
         */
        if ($contact->phone) {
            $apiToken = config('services.mista.api_token');
            $senderId = config('services.mista.sender_id');

            // format phone number to 2507... if Rwandan MTN
            $phone = preg_replace('/[^0-9]/', '', $contact->phone);
            if (Str::startsWith($phone, '07')) {
                $phone = '250' . substr($phone, 1);
            }

            $smsMessage = "Hello {$contact->first_name},\n\n"
                . "Our support team has replied to your contact request (#{$contact->ticket}).\n\n"
                . "Message: {$messageText}\n\n"
                . "Thank you for reaching out to us.";

            try {
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer ' . $apiToken,
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ])->post('https://api.mista.io/sms', [
                    'to' => $phone,
                    'from' => $senderId,
                    'message' => $smsMessage,
                ]);

                Log::info('📩 SMS Response: ' . $response->body());
            } catch (\Exception $e) {
                Log::error('❌ SMS sending failed: ' . $e->getMessage());
            }
        }

           $contact->update(['status' => $validated['status']]);

        return back()->with('success', 'Reply sent successfully via Email and SMS.');
    }
}
