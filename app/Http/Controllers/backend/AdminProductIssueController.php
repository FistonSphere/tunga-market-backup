<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Models\ProductIssue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdminProductIssueController extends Controller
{
   
   public function index(){
   $issues = ProductIssue::with('order','user','product')->paginate('15');
   
    return view('admin.product-issues.index',compact('issues'));
   }

public function reply(Request $request)
{
    $request->validate([
        'issue_id' => 'required|exists:product_issues,id',
        'reply_message' => 'required|string',
        'status' => 'required|in:pending,resolved'
    ]);

    try {
        Log::info("🟡 Starting product issue reply process", ['request' => $request->all()]);

        $issue = ProductIssue::with(['user', 'product', 'order'])->findOrFail($request->issue_id);
        $issue->update(['status' => $request->status]);

        $user = $issue->user;
        $subject = "Response to Your Product Issue – Tunga Market";

        // Prepare HTML email
        $emailContent = view('emails.issue_reply', [
            'user' => $user,
            'reply' => $request->reply_message,
            'status' => ucfirst($request->status),
            'issue' => $issue
        ])->render();

        // ✅ EMAIL DEBUGGING BLOCK
        try {
            Log::info("🟡 Sending email to user", ['email' => $user->email]);

            Mail::send([], [], function ($message) use ($user, $subject, $emailContent) {
                $message->to($user->email)
                    ->subject($subject)
                    ->html($emailContent);
            });

            if (count(Mail::failures()) > 0) {
                Log::error("❌ Email sending failed", ['failures' => Mail::failures()]);
            } else {
                Log::info("✅ Email successfully sent to " . $user->email);
            }
        } catch (\Throwable $e) {
            Log::error("❌ Email exception", ['error' => $e->getMessage()]);
        }

        // ✅ SMS via Mista.io
        try {
            $apiToken = config('services.mista.api_token');
            $senderId = config('services.mista.sender_id');

            if (!$apiToken || !$senderId) {
                Log::error("❌ Missing Mista API credentials");
            }

            $productName = $issue->product->name ?? 'Your Product';
            $Issuemessage = $issue->message;
            $smsMessage = "Tunga Market Support 💬\nHello {$user->first_name},\nWe reviewed your issue about {$productName}.\nReply: \"{$request->reply_message}\"\nStatus: " . ucfirst($request->status) . "\nThanks for shopping with us! 🧡";

            Log::info("🟡 Sending SMS via Mista.io", [
                'recipient' => $user->phone,
                'message' => $smsMessage
            ]);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiToken,
                'accept' => 'application/json',
                'content-type' => 'application/json'
            ])->post('https://api.mista.io/sms', [
                'to' => $user->phone,
                'from' => $senderId,
                'unicode' => 0,
                'sms' => $smsMessage,
            ]);

            Log::info("📡 Mista response", [
                'status' => $response->status(),
                'body' => $response->json()
            ]);

            if (!$response->successful()) {
                Log::error("❌ Mista SMS failed", [
                    'http_code' => $response->status(),
                    'body' => $response->body()
                ]);
            } else {
                Log::info("✅ Mista SMS successfully sent to {$user->phone}");
            }
        } catch (\Throwable $e) {
            Log::error("❌ SMS exception", ['error' => $e->getMessage()]);
        }

        return back()->with('success', 'Reply sent and debugging logs recorded.');
    } catch (\Throwable $e) {
        Log::error("❌ Unexpected error in reply()", ['error' => $e->getMessage()]);
        return back()->with('error', 'An unexpected error occurred. Check logs for details.');
    }
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
