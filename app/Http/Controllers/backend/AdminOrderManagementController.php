<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AdminOrderManagementController extends Controller
{

   public function index(Request $request){
   $query = Order::with(['user', 'items.product', 'shippingAddress', 'payment']);

    // === Optional Filters ===
    if ($request->status) {
        $query->where('status', $request->status);
    }

    if ($request->from && $request->to) {
        $query->whereBetween('created_at', [$request->from, $request->to]);
    }

    if ($request->payment_method) {
        $query->where('payment_method', $request->payment_method);
    }

    $orders = $query->latest()->paginate(3);

    // === Metrics ===
    $metrics = [
        'total_orders'   => Order::count(),
        'processing'     => Order::where('status', 'processing')->count(),
        'delivered'      => Order::where('status', 'delivered')->count(),
        'cancelled'      => Order::where('status', 'cancelled')->count(),
        'revenue'        => Payment::where('status', 'success')->sum('amount'),
        'pending_payment'=> Payment::where('status', 'pending')->count(),
    ];

    // === Revenue trend (last 7 days) ===
    $revenueTrend = Order::selectRaw('DATE(created_at) as date, SUM(total) as total')
        ->where('status', 'delivered')
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->take(7)
        ->get();

    // === Top Buyers ===
    $topBuyers = User::withCount('orders')
        ->orderByDesc('orders_count')
        ->take(5)
        ->get();

    // === Payment Stats ===
    $paymentStats = Payment::select('payment_method', DB::raw('COUNT(*) as count'))
        ->groupBy('payment_method')
        ->pluck('count', 'payment_method');

        $orderTrend = Order::selectRaw('DATE(created_at) as date, COUNT(*) as count')
    ->groupBy('date')
    ->orderBy('date', 'asc')
    ->take(7)
    ->get();
    return view('admin.orders.listing', compact('orders', 'metrics', 'revenueTrend', 'topBuyers', 'paymentStats','orderTrend'));
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


public function updateStatus(Request $request, Order $order)
{
    $validated = $request->validate([
        'status' => 'required|in:Processing,Delivered,Canceled',
    ]);

    $order->update(['status' => $validated['status']]);

    return response()->json(['status' => 'success', 'message' => 'Order status updated successfully.']);
}


}
