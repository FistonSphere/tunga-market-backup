<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdminEnquiryController extends Controller
{
   public function index()
{
    $products = Product::where('status', 'active')->get();
    $enquiries = Enquiry::with('product')->orderBy('created_at', 'desc')->paginate(10);
    return view('admin.products.enquiries', compact('enquiries','products'));
}
public function EnquiriesDestroy(Enquiry $enquiry)
    {
        $enquiry->delete();
        return response()->json(['status' => 'success', 'message' => 'Enquiry deleted successfully.']);
    }

 public function showConversation(Enquiry $enquiry)
    {
        $enquiry->load(['replies.user', 'product']);
        return response()->json($enquiry);
    }

    public function sendReply(Request $request, Enquiry $enquiry)
    {
        $validated = $request->validate(['message' => 'required|string']);

        $reply = $enquiry->replies()->create([
            'user_id' => auth()->id(),
            'message' => $validated['message'],
        ]);

        // You could also send an email notification to the user here

        return response()->json([
            'status' => 'success',
            'message' => 'Reply sent successfully.',
            'reply' => [
                'message' => $reply->message,
                'user' => auth()->user()->first_name ?? 'Admin',
                'created_at' => $reply->created_at->diffForHumans()
            ]
        ]);
    }

    public function reply(Request $request)
{
    $request->validate([
        'enquiry_id' => 'required|exists:enquiries,id',
        'subject' => 'nullable|string|max:255',
        'email_message' => 'nullable|string',
        'sms_message' => 'nullable|string|max:320',
    ]);

    $enquiry = Enquiry::with('product')->findOrFail($request->enquiry_id);

    // ✅ EMAIL
    if ($request->email_message) {
        $emailContent = view('emails.reply_enquiry', [
            'enquiry' => $enquiry,
            'messageText' => $request->email_message,
        ])->render();

        try {
            Mail::send([], [], function ($message) use ($enquiry, $request, $emailContent) {
                $message->to($enquiry->email)
                        ->subject($request->subject)
                        ->html($emailContent);
            });
            Log::info("📧 Reply email sent to {$enquiry->email}");
        } catch (\Exception $e) {
            Log::error('❌ Email sending failed: ' . $e->getMessage());
        }
        return back()->with('success', 'Reply sent successfully via Email.');
    }

    // ✅ SMS
    if ($request->sms_message && $enquiry->phone) {
        $apiToken = config('services.mista.api_token');
        $senderId = config('services.mista.sender_id');

        // Format to MTN: +2507... if not already
        $phone = preg_replace('/^0/', '+250', $enquiry->phone);
        if (!str_starts_with($phone, '+250')) {
            $phone = '+250' . ltrim($enquiry->phone, '0');
        }

        try {
            Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'accept' => 'application/json',
                'content-type' => 'application/json'
            ])->post('https://api.mista.io/sms', [
                'to' => $phone,
                'from' => $senderId,
                'message' => $request->sms_message,
            ]);
            Log::info("📩 SMS sent successfully to {$phone}");
        } catch (\Exception $e) {
            Log::error('❌ SMS sending failed: ' . $e->getMessage());
        }
        return back()->with('success', 'Reply sent successfully via SMS.');
    }

}


public function search(Request $request)
{
    $query = Enquiry::query()->with('product');

    // 🔍 Filter by text search
    if ($request->filled('search')) {
        $search = $request->input('search');

        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('company', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%")
              ->orWhere('ticket', 'like', "%{$search}%")
              ->orWhereHas('product', function ($p) use ($search) {
                  $p->where('name', 'like', "%{$search}%");
              });
        });
    }

    // 🧩 Filter by specific product
    if ($request->filled('product_id')) {
        $query->where('product_id', $request->product_id);
    }

    // Optional: you can order by latest
    $enquiries = $query->latest()->paginate(10)->withQueryString();

    // Load all products for filter dropdown
    $products = Product::select('id', 'name')->orderBy('name')->get();

    return view('admin.products.enquiries', compact('enquiries', 'products'));
}


public function destroy(Enquiry $enquiry)
    {
        $enquiry->delete();
        return back()->with('success', 'Enquiry deleted successfully.');
    }
}
