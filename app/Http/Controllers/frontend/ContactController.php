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

class ContactController extends Controller
{
   public function index()
   {
       // Logic to retrieve and display contact information
       return view('frontend.contact'); // Adjust the view name as necessary
   }

   public function store(Request $request)
    {
        // ✅ 1. Validate input
        $validated = $request->validate([
            'first-name' => 'required|string|max:100',
            'last-name' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'company' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:100',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:50',
            'priority' => 'required|in:low,medium,high',
            'contact_type_title' => 'nullable|string|max:255',
            'contact_type_description' => 'nullable|string|max:255',
            'callback-request' => 'nullable|boolean',
            'callback-time' => 'nullable|string',
            'callback-timezone' => 'nullable|string',
            'attachments.*' => 'nullable|file|max:10240|mimes:pdf,doc,docx,xls,xlsx,png,jpg,jpeg',
        ]);

        // ✅ 2. Handle file uploads
        $attachmentPaths = [];
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('contact_attachments', 'public');
                $attachmentPaths[] = Storage::url($path); // Generates public URL
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
            'attachments' => $attachmentPaths,
            'callback_requested' => $request->has('callback-request'),
            'callback_time' => $request->input('callback-time'),
            'callback_timezone' => $request->input('callback-timezone'),
        ]);

        // ✅ 4. Notify Admin(s)
        $admins = User::where('role', 1)->get(); // Role 1 = admin
        foreach ($admins as $admin) {
            Mail::to($admin->email)->send(new ContactRequestNotification($contact));
        }

        // ✅ 5. Notify user (confirmation)
        Mail::to($contact->email)->send(new ContactRequestConfirmation($contact));

        return response()->json(['message' => 'Your message has been sent successfully!']);
    }
}
