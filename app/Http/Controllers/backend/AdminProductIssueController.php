<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\ProductIssue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdminProductIssueController extends Controller
{
   
   public function index(){
   $issues = ProductIssue::with('order','user','product')->get();
   
    return view('admin.product-issues.index',compact('issues'));
   }

public function reply(Request $request)
{
    $request->validate([
        'issue_id' => 'required|exists:product_issues,id',
        'reply_message' => 'required|string',
        'status' => 'required|in:pending,resolved'
    ]);

    $issue = ProductIssue::with(['user', 'product', 'order'])->findOrFail($request->issue_id);
    $issue->update(['status' => $request->status]);

    $user = $issue->user;
    $subject = "Response to Your Product Issue – Tunga Market";

    // ✅ Prepare Email Content
    $emailContent = view('emails.issue_reply', [
        'user' => $user,
        'reply' => $request->reply_message,
        'status' => ucfirst($request->status),
        'issue' => $issue
    ])->render();

    // ✅ Send Email
    try {
        Mail::send([], [], function ($message) use ($user, $subject, $emailContent) {
            $message->to($user->email)
                ->subject($subject)
                ->html($emailContent);
        });
        Log::info("✅ Product issue reply email sent to {$user->email}");
    } catch (\Exception $e) {
        Log::error("❌ Email sending failed: " . $e->getMessage());
    }

    // ✅ Send SMS via Mista API
    try {
        $apiToken = config('services.mista.api_token');
        $senderId = config('services.mista.sender_id');

        $productName = $issue->product->name ?? 'Your Product';
        $status = ucfirst($request->status);
        $reply = $request->reply_message;

        // 🧡 Interactive, branded SMS message (multi-line)
        $smsMessage = 
"Tunga Market Support 💬
----------------------------------
Hello {$user->first_name},

We’ve reviewed your issue regarding:
📦 Product: {$productName}

💬 Our Reply:
\"{$reply}\"

📌 Current Status: {$status}

Need more help? Simply reply or visit your Tunga Market account.

Thank you for shopping with us! 🧡
----------------------------------
© " . date('Y') . " Tunga Market | tunga.rw";

        // Send SMS request
        $response = Http::withHeaders([
            'accept' => 'application/json',
            'content-type' => 'application/json',
            'Authorization' => 'Bearer ' . $apiToken,
        ])->post('https://api.mista.io/sms', [
            'recipient' => $user->phone,
            'sender_id' => $senderId,
            'message' => $smsMessage,
            'type' => 'plain',
        ]);

        if ($response->successful()) {
            Log::info("✅ Reply SMS successfully sent to {$user->phone}");
        } else {
            Log::error("❌ Failed to send reply SMS. Response: " . $response->body());
        }
    } catch (\Exception $e) {
        Log::error("❌ SMS sending error: " . $e->getMessage());
    }

    return back()->with('success', 'Reply sent successfully via Email and SMS, and status updated.');
}




    // Fetch order items for modal
    public function getOrderItems($orderId)
    {
        $items = OrderItem::where('order_id', $orderId)
            ->with('product:id,name,main_image')
            ->get()
            ->map(function ($item) {
                return [
                    'order_no'=>$item->order_no ?? '',
                    'product_image' => $item->product->main_image,
                    'product_name' => $item->product->name ?? 'Unknown',
                    'quantity' => $item->quantity,
                    'price' => number_format($item->price)
                ];
            });
        return response()->json($items);
    }

}
