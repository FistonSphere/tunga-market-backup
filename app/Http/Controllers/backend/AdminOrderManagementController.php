<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdminOrderManagementController extends Controller
{
   public function Orderlist(){
    $orders = Order::with(['user', 'items.product', 'payment', 'shippingAddress'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
    return view('admin.orders.index', compact('orders'));
   }

   public function show($id)
  {
    $order = Order::with(['user', 'items.product', 'shippingAddress', 'payment'])->findOrFail($id);
    return response()->json($order);
}

public function contactBuyer(Request $request)
{
    $request->validate([
        'order_id' => 'required|exists:orders,id',
        'message' => 'required|string|max:1000',
    ]);

    $order = Order::with(['user', 'shippingAddress', 'items.product'])->findOrFail($request->order_id);
    $user = $order->user;

    $subject = "Message from Tunga Market – Order #{$order->invoice_number}";
    $messageText = $request->message;

    // ========== EMAIL ==========
    $emailContent = view('emails.contact_buyer', [
        'user' => $user,
        'order' => $order,
        'messageText' => $messageText,
    ])->render();

    try {
        Mail::send([], [], function ($message) use ($user, $subject, $emailContent) {
            $message->to($user->email)
                ->subject($subject)
                ->html($emailContent);
        });
        Log::info("✅ Buyer email sent successfully to {$user->email}");
    } catch (\Exception $e) {
        Log::error("❌ Failed to send email to buyer: " . $e->getMessage());
    }

    // ========== SMS ==========
    $apiToken = config('services.mista.api_token');
    $senderId = config('services.mista.sender_id');
    $smsMessage = "Hello {$user->first_name},\n\n"
        . "Tunga Market Support Team has sent you a message regarding your order #{$order->invoice_number}.\n\n"
        . "Message: {$messageText}\n\n"
        . "Thank you for shopping with Tunga Market.";

    try {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $apiToken,
            'accept' => 'application/json',
            'content-type' => 'application/json'
        ])->post('https://api.mista.io/sms', [
            'to' => $order->user->phone,
            'from' => $senderId,
            'message' => $smsMessage,
        ]);

        Log::info('📩 SMS Response: ' . $response->body());
    } catch (\Exception $e) {
        Log::error('❌ SMS sending failed: ' . $e->getMessage());
    }

    return back()->with('success', 'Message sent successfully to buyer via email and SMS.');
}

}
