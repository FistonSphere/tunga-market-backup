<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactRequestNotification;
use App\Mail\ContactRequestConfirmation;
use App\Models\ContactRequest;
use App\Models\Enquiry;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Models\Notification;
use App\Models\Product;
use Illuminate\Support\Facades\Http;

class ContactController extends Controller
{
   public function index()
   {
       // Logic to retrieve and display contact information
       $socialPlatforms = [
    'facebook' => [
        'label' => 'Facebook',
        'color' => 'blue-700',
        'response' => '1-2 hours',
        'icon' => 'facebook',
    ],
    'twitter' => [
        'label' => 'Twitter',
        'color' => 'blue-500',
        'response' => '1-3 hours',
        'icon' => 'twitter',
    ],
    'linkedin' => [
        'label' => 'LinkedIn',
        'color' => 'blue-600',
        'response' => '2-4 hours',
        'icon' => 'linkedin',
    ],
    'instagram' => [
        'label' => 'Instagram',
        'color' => 'pink-600',
        'response' => '2-3 hours',
        'icon' => 'instagram',
    ],
    'tiktok' => [
        'label' => 'TikTok',
        'color' => 'black',
        'response' => '1-2 hours',
        'icon' => 'tiktok',
    ],
    'whatsapp' => [
        'label' => 'WhatsApp',
        'color' => 'green-600',
        'response' => '15–30 minutes',
        'icon' => 'whatsapp',
    ],
];

       return view('frontend.contact',compact( 'socialPlatforms')); // Adjust the view name as necessary
   }

   public function store(Request $request)
{
    Log::debug('📥 Contact form submission received.', $request->all());

    try {
        /**
         * ===================================
         * ✅ 1. Validate Input
         * ===================================
         */
        $validated = $request->validate([
            'first-name' => 'required|string|max:100',
            'last-name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:100',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'priority' => 'required|in:low,medium,high',
            'contact_type_title' => 'nullable|string|max:255',
            'contact_type_description' => 'nullable|string|max:255',
            'callback-request' => 'nullable',
            'callback-time' => 'nullable|string',
            'callback-timezone' => 'nullable|string',
            'attachments.*' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,png,jpg,jpeg',
        ]);

        Log::debug('✅ Validation passed.', $validated);

        /**
         * ===================================
         * 📂 2. Handle File Uploads
         * ===================================
         */
        $attachments = [];

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('contact_attachments', $filename, 'public');
                $attachments[] = asset('storage/' . $path);
            }
        }

        /**
         * ===================================
         * 💾 3. Save to Database
         * ===================================
         */
        $contact = ContactRequest::create([
            'first_name' => $validated['first-name'],
            'last_name'  => $validated['last-name'],
            'email'      => $validated['email'],
            'phone'      => $validated['phone'] ?? null,
            'company'    => $validated['company'] ?? null,
            'role'       => $validated['role'] ?? null,
            'subject'    => $validated['subject'],
            'message'    => $validated['message'],
            'priority'   => $validated['priority'],
            'contact_type_title'       => $request->input('contact_type_title'),
            'contact_type_description' => $request->input('contact_type_description'),
            'attachments'              => json_encode($attachments),
            'callback_requested'       => $request->has('callback-request'),
            'callback_time'            => $request->input('callback-time'),
            'callback_timezone'        => $request->input('callback-timezone'),
        ]);

        Log::info('💾 Contact request saved successfully.', ['id' => $contact->id]);

        /**
         * ===================================
         * 🔔 4. Create Notification Record
         * ===================================
         */
       $admins = User::where('is_admin', 'yes')->get();

          try {
            foreach ($admins as $admin) {
           Notification::create([
            'user_id'   => null,
            'admin_id'  => $admin->id,
            'type'      => 'contact_request',
            'title'     => 'New Contact Request Received',
            'message'   => "A new contact request was submitted by {$contact->first_name} {$contact->last_name} ({$contact->email}).",
            'data'      => [
                'contact_id' => $contact->id,
                'priority'   => $contact->priority,
                'subject'    => $contact->subject,
                'email'      => $contact->email,
            ],
            'action_time' => now(),
        ]);
    }

    Log::info("✅ Admin notifications created for contact #{$contact->id}");
} catch (\Exception $e) {
    Log::error("❌ Failed to create admin notifications: " . $e->getMessage());
}


        /**
         * ===================================
         * ✉️ 5. Notify Admins via Email & SMS
         * ===================================
         */
        $admins = User::where('is_admin', 'yes')->get();

        foreach ($admins as $admin) {
            // Email Notification
            try {
                $emailTitle = '📩 New Contact Request Received';
                $emailBody = "{$contact->first_name} {$contact->last_name} has submitted a contact request.";
                $emailData = [
                    'Contact ID' => $contact->id,
                    'Priority'   => ucfirst($contact->priority),
                    'Subject'    => $contact->subject,
                    'Email'      => $contact->email,
                    'Phone'      => $contact->phone ?: 'N/A',
                    'Company'    => $contact->company ?: 'N/A',
                ];

                Mail::send('emails.admin_notification', [
                    'title' => $emailTitle,
                    'messageBody' => $emailBody,
                    'data' => $emailData,
                ], function ($message) use ($admin, $emailTitle) {
                    $message->to($admin->email)->subject($emailTitle);
                });

                Log::info("✅ Admin email sent to {$admin->email}");
            } catch (\Exception $e) {
                Log::error("❌ Failed to send email to admin {$admin->email}: " . $e->getMessage());
            }

            // SMS Notification via Mista.io
            try {
                if ($admin->phone) {
                    $apiToken = config('services.mista.api_token');
                    $senderId = config('services.mista.sender_id');

                    $phone = preg_replace('/\D/', '', $admin->phone);
                    if (Str::startsWith($phone, '07')) {
                        $phone = '250' . substr($phone, 1);
                    } elseif (!Str::startsWith($phone, '+')) {
                        $phone = '+' . $phone;
                    }

                    $smsMessage = "📢 New Contact Request:\n"
                        . "{$contact->first_name} {$contact->last_name}\n"
                        . "Subject: {$contact->subject}\n"
                        . "Priority: {$contact->priority}\n"
                        . "Check your dashboard.";

                    $response = Http::withHeaders([
                        'Authorization' => 'Bearer ' . $apiToken,
                        'accept' => 'application/json',
                        'content-type' => 'application/json',
                    ])->post('https://api.mista.io/sms', [
                        'to' => $phone,
                        'from' => $senderId,
                        'message' => $smsMessage,
                    ]);

                    Log::info("✅ SMS sent to Admin {$admin->phone}: " . $response->body());
                }
            } catch (\Exception $e) {
                Log::error("❌ SMS sending failed to {$admin->phone}: " . $e->getMessage());
            }
        }

        /**
         * ===================================
         * 📬 6. Notify User (Confirmation)
         * ===================================
         */
        try {
            Mail::to($contact->email)->send(new ContactRequestConfirmation($contact));
            Log::info("📨 Confirmation email sent to {$contact->email}");
        } catch (\Exception $e) {
            Log::error("❌ Failed to send confirmation email to user: " . $e->getMessage());
        }

        return redirect()->back()->with('success', '✅ Your message has been sent successfully. We will get back to you shortly.');

    } catch (\Exception $e) {
        Log::error('❌ Error in contact form submission', [
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        return redirect()->back()->with('error', 'Something went wrong. Please try again later.');
    }
}



public function storeEnquiry(Request $request){

        $request->validate([
            'name'        => 'required|string|max:255',
            'company'     => 'nullable|string|max:255',
            'email'       => 'required|email',
            'phone'       => 'nullable|string|max:20',
            'quantity'    => 'required|string',
            'target_price'=> 'nullable|string|max:255',
            'message'     => 'required|string',
            'terms'       => 'accepted',
            'product_id'  => 'required|exists:products,id',
        ]);

        // ✅ Save enquiry
    $enquiry = Enquiry::create($request->only([
        'name', 'company', 'email', 'phone', 'quantity', 'target_price', 'message', 'product_id'
    ]));

    // ✅ Load product for context
    $product = Product::find($request->product_id);

   // ✅ Create admin notification
   $admins = User::where('is_admin', 'yes')->get();
try {
    // Create notification record
    foreach ($admins as $admin) {
    Notification::create([
        'user_id' => null, // guest
        'admin_id' => $admin->id, // or loop for all admins
        'type' => 'product_enquiry',
        'title' => 'New Product Enquiry',
        'message' => "{$request->name} submitted an enquiry for product '{$product->title}' (Qty: {$request->quantity}).",
        'data' => [
            'enquiry_id' => $enquiry->id,
            'product_id' => $product->id,
            'product_title' => $product->title,
            'email' => $request->email,
            'quantity' => $request->quantity,
            'target_price' => $request->target_price,
        ],
        'action_time' => now(),
    ]);
    }
    Log::info("✅ Admin notification created for product enquiry #{$enquiry->id}");

    /**
     * =======================
     * ✉️ EMAIL NOTIFICATION
     * =======================
     */
    try {
        $admin = User::where('is_admin', 'yes')->get(); // Change this if multiple admins
        if ($admin && $admin->email) {
            $emailTitle = '🛒 New Product Enquiry Received';
            $emailBody = "{$request->name} submitted a new enquiry for <strong>{$product->title}</strong>.";
            $emailData = [
                'Enquiry ID' => $enquiry->id,
                'Product' => $product->title,
                'Quantity' => $request->quantity,
                'Target Price' => $request->target_price ?: 'N/A',
                'Email' => $request->email,
                'Phone' => $request->phone ?: 'N/A',
                'Message' => $request->message,
            ];

            Mail::send('emails.admin_notification', [
                'title' => $emailTitle,
                'messageBody' => $emailBody,
                'data' => $emailData,
            ], function ($message) use ($admin, $emailTitle) {
                $message->to($admin->email)
                        ->subject($emailTitle);
            });

            Log::info("✅ Admin email notification sent to {$admin->email}");
        }
    } catch (\Exception $e) {
        Log::error("❌ Failed to send admin email for enquiry #{$enquiry->id}: " . $e->getMessage());
    }

    /**
     * =======================
     * 📱 SMS NOTIFICATION (MISTA.IO)
     * =======================
     */
    try {
        $admin = User::find(6);
        if ($admin && $admin->phone) {
            $apiToken = config('services.mista.api_token');
            $senderId = config('services.mista.sender_id');

            // Normalize phone
            $phone = preg_replace('/\s+/', '', $admin->phone);
            if (Str::startsWith($phone, '07')) {
                $phone = '250' . substr($phone, 1); // Rwanda
            } elseif (!Str::startsWith($phone, '+')) {
                $phone = '+'.$phone;
            }

            $smsMessage = "📢 Tunga Market Admin Alert:\n"
                . "{$request->name} just submitted a product enquiry for '{$product->title}'.\n"
                . "Qty: {$request->quantity}\n"
                . "Email: {$request->email}\n"
                . "Check dashboard for details.";

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'accept' => 'application/json',
                'content-type' => 'application/json',
            ])->post('https://api.mista.io/sms', [
                'to' => $phone,
                'from' => $senderId,
                'message' => $smsMessage,
            ]);

            Log::info("✅ SMS sent to Admin ({$phone}) for Enquiry #{$enquiry->id}: " . $response->body());
        }
    } catch (\Exception $e) {
        Log::error("❌ Failed to send SMS for enquiry #{$enquiry->id}: " . $e->getMessage());
    }

} catch (\Exception $e) {
    Log::error("❌ Failed to create notification for enquiry #{$enquiry->id}: " . $e->getMessage());
}


        return response()->json([
            'success' => true,
            'message' => 'Enquiry sent successfully!'
        ]);

}


 public function showTicket($ticket)
    {
        $request = ContactRequest::where('ticket', $ticket)->first();

        if (!$request) {
            return response()->json(['error' => 'Ticket not found'], 404);
        }

        return response()->json([
            'ticket' => $request->ticket,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'company' => $request->company,
            'role' => $request->role,
            'subject' => $request->subject,
            'message' => $request->message,
            'status' => $request->status,
            'priority' => $request->priority,
            'contact_type_title' => $request->contact_type_title,
            'contact_type_description' => $request->contact_type_description,
            'callback_requested' => $request->callback_requested,
            'callback_time' => $request->callback_time,
            'callback_timezone' => $request->callback_timezone,
            'attachments' => $request->attachments,
            'created_at' => $request->created_at->format('M d, Y h:i A'),
        ]);
    }

}
