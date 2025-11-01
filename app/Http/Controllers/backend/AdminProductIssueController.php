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
        Log::info("🟡 Starting issue reply process", ['request' => $request->all()]);

        $issue = ProductIssue::with(['user', 'product', 'order'])->findOrFail($request->issue_id);
        $issue->update(['status' => $request->status]);

        $user = $issue->user;
        $product = $issue->product;
        $order = $issue->order;

        $subject = "Response to Your Product Issue – Tunga Market";

        // ✅ HTML Email content
        $emailContent = view('emails.issue_reply', [
            'user' => $user,
            'reply' => $request->reply_message,
            'status' => ucfirst($request->status),
            'issue' => $issue
        ])->render();

        /**
         * -----------------------------------------------------
         * EMAIL SENDING + DEBUG LOGS
         * -----------------------------------------------------
         */
        try {
            Log::info("🟡 Sending email to user", ['email' => $user->email]);

            Mail::send([], [], function ($message) use ($user, $subject, $emailContent) {
                $message->to($user->email)
                    ->subject($subject)
                    ->html($emailContent);
            });

            if (count(Mail::failures()) > 0) {
                Log::error("❌ Email failed", ['failures' => Mail::failures()]);
            } else {
                Log::info("✅ Email successfully sent to " . $user->email);
            }
        } catch (\Throwable $e) {
            Log::error("❌ Email exception", ['error' => $e->getMessage()]);
        }

        /**
         * -----------------------------------------------------
         * SMS SENDING via Mista.io + DEBUG LOGS
         * -----------------------------------------------------
         */
        try {
            $apiToken = config('services.mista.api_token');
            $senderId = config('services.mista.sender_id');

            if (!$apiToken || !$senderId) {
                Log::error("❌ Missing Mista API credentials");
            }

            // 🔹 Compose Interactive SMS Content
            $productName = $product->name ?? 'Unknown Product';
            $invoice = $order->invoice_number ?? 'N/A';
            $question = trim($issue->message);
            $reply = trim($request->reply_message);
            $status = ucfirst($request->status);

$smsMessage =
"Tunga Market - Support Update

Hello {$user->first_name},

We have reviewed your product issue.

Product: {$productName}
Invoice: #{$invoice}

Your Message:
{$question}

Our Reply:
{$reply}

Current Status: {$status}

Thank you for shopping with Tunga Market.
Visit tungamarket.com for more assistance.";


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
                'unicode' => 1, // allow emojis & formatting
                'sms' => $smsMessage,
            ]);

            Log::info("📡 Mista Response", [
                'status' => $response->status(),
                'body' => $response->json()
            ]);

            if (!$response->successful()) {
                Log::error("❌ Mista SMS Failed", [
                    'http_code' => $response->status(),
                    'body' => $response->body()
                ]);
            } else {
                Log::info("✅ Mista SMS sent successfully to {$user->phone}");
            }
        } catch (\Throwable $e) {
            Log::error("❌ SMS Exception", ['error' => $e->getMessage()]);
        }

        return back()->with('success', 'Reply sent successfully via Email and SMS.');
    } catch (\Throwable $e) {
        Log::error("❌ Unexpected Error in reply()", ['error' => $e->getMessage()]);
        return back()->with('error', 'An error occurred. Please check logs.');
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
