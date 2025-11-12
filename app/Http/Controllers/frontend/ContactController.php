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

class ContactController extends Controller
{
   public function index()
   {
       // Logic to retrieve and display contact information
       return view('frontend.contact'); // Adjust the view name as necessary
   }

   public function store(Request $request)
{
    Log::debug('📥 Contact form submission received.', $request->all());

    try {
        // ✅ 1. Validate input
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

        // ✅ 2. Handle file uploads
        $attachments = [];

    if ($request->hasFile('attachments')) {
        foreach ($request->file('attachments') as $file) {
            $filename = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('contact_attachments', $filename, 'public');

            // Convert to full URL using asset()
            $attachments[] = asset('storage/' . $path);
        }
    }

        // ✅ 3. Save to database
        $contact = ContactRequest::create([
            'first_name' => $validated['first-name'],
            'last_name' => $validated['last-name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'company' => $validated['company'] ?? null,
            'role' => $validated['role'] ?? null,
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'priority' => $validated['priority'],
            'contact_type_title' => $request->input('contact_type_title'),
            'contact_type_description' => $request->input('contact_type_description'),
            'attachments' => json_encode($attachments),
            'callback_requested' => $request->has('callback-request'),
            'callback_time' => $request->input('callback-time'),
            'callback_timezone' => $request->input('callback-timezone'),
        ]);

        Log::info('💾 Contact request saved', ['id' => $contact->id]);

        // 🔹 Create notification for admin(s)
try {



        Notification::create([
            'user_id' => null, // contact may not be a registered user
            'admin_id' => 6,
            'type' => 'contact_request',
            'title' => 'New Contact Request Received',
            'message' => "A new contact request was submitted by {$contact->first_name} {$contact->last_name} ({$contact->email}).",
            'data' => [
                'contact_id' => $contact->id,
                'priority' => $contact->priority,
                'subject' => $contact->subject,
                'email' => $contact->email,
            ],
            'action_time' => now(),
        ]);

        Log::info("✅ Notification created for admin ID: 9 for contact ID: {$contact->id}");

} catch (\Exception $e) {
    Log::error("❌ Failed to create admin notification for contact request: " . $e->getMessage());
}
        // ✅ 4. Notify Admin(s)
        $admins = User::where('role', 1)->get();
        foreach ($admins as $admin) {
            Log::info("📧 Sending notification to admin: {$admin->email}");
            Mail::to($admin->email)->send(new ContactRequestNotification($contact));
        }

        // ✅ 5. Notify user (confirmation)
        Mail::to($contact->email)->send(new ContactRequestConfirmation($contact));
        Log::info("📨 Confirmation email sent to: {$contact->email}");

        return redirect()->back()->with('success', 'Your message has been sent successfully. We will get back to you shortly.');
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
    try {

            Notification::create([
                'user_id' => null, // enquiry is from a guest
                'admin_id' => 6,
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

        Log::info("✅ Admin notification created for product enquiry #{$enquiry->id}");
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
