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

    $issue = ProductIssue::with(['user', 'product', 'order'])->findOrFail($request->issue_id);

    // --- Append reply to JSON queue ---
    $replies = $issue->replies ?? [];
    $replies[] = [
        'message' => $request->reply_message,
        'by' => 'admin',
        'timestamp' => now()->toDateTimeString(),
    ];

    $issue->update([
        'replies' => $replies,
        'status' => $request->status,
    ]);

    $user = $issue->user;
    $subject = "Response to Your Product Issue – Tunga Market";

    // =============== EMAIL TO USER ===============
    $emailContent = view('emails.issue_reply', [
        'user' => $user,
        'reply' => $request->reply_message,
        'status' => ucfirst($request->status),
        'issue' => $issue
    ])->render();

    try {
        Mail::send([], [], function ($message) use ($user, $subject, $emailContent) {
            $message->to($user->email)
                ->subject($subject)
                ->html($emailContent);
        });
        Log::info("✅ Reply email sent successfully to {$user->email}");
    } catch (\Exception $e) {
        Log::error("❌ Failed to send reply email: " . $e->getMessage());
    }

    // =============== SMS TO USER ===============
    $apiToken = config('services.mista.api_token');
    $senderId = config('services.mista.sender_id');

    $smsMessage =
        "Hello {$user->first_name},\n\n"
        . "We've reviewed your issue about \"{$issue->product->name}\" "
        . "from invoice #{$issue->order->invoice_number}.\n\n"
        . "Your message: {$issue->message}\n"
        . "Tunga Market reply: {$request->reply_message}\n\n"
        . "Status: " . ucfirst($request->status) . "\n\n"
        . "Thank you for shopping with Tunga Market.";

    try {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiToken,
            'accept' => 'application/json',
            'content-type' => 'application/json'
        ])->post('https://api.mista.io/sms', [
            'to' => $user->phone,
            'from' => $senderId,
            'message' => $smsMessage
        ]);

        Log::info('📩 SMS Response: ' . $response->body());
    } catch (\Exception $e) {
        Log::error('❌ SMS sending failed: ' . $e->getMessage());
    }

    // =============== ADMIN NOTIFICATION ===============
    $adminEmail = env('MAIL_USERNAME');
    $adminSubject = "New Reply Sent to {$user->first_name} – Product Issue Update";

    $adminEmailContent = view('emails.admin_issue_report', [
        'issue' => $issue,
        'reply' => $request->reply_message,
        'admin' => 'Tunga Market Support Team'
    ])->render();

    try {
        Mail::send([], [], function ($message) use ($adminEmail, $adminSubject, $adminEmailContent) {
            $message->to($adminEmail)
                ->subject($adminSubject)
                ->html($adminEmailContent);
        });
        Log::info("✅ Admin notified successfully at {$adminEmail}");
    } catch (\Exception $e) {
        Log::error("❌ Failed to notify admin: " . $e->getMessage());
    }

    return back()->with('success', 'Reply added successfully and notifications delivered.');
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

    public function getTimeline($id)
{
    $issue = ProductIssue::with(['product', 'order', 'user'])->findOrFail($id);

    return response()->json([
        'product_name' => $issue->product->name ?? 'Unknown',
        'product_image' => $issue->product->main_image ?? asset('assets/images/no-image.png'),
        'invoice_number' => $issue->order->invoice_number ?? 'N/A',
        'status' => $issue->status,
        'user_message' => $issue->message,
        'reply_message' => $issue->reply_message ?? null,
        'created_at' => $issue->created_at->format('d M Y, H:i'),
        'updated_at' => $issue->updated_at->format('d M Y, H:i')
    ]);
}

}
