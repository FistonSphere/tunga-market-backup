<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
   public function index()
   {
    $orders = OrderItem::with(['order', 'product'])
    ->whereHas('order', function ($query) {
        $query->where('user_id', 4); // replace with actual user_id
    })
    ->get();

// dd($orders);

       // Logic to show the order tracking page
       return view('frontend.order-tracking',[
        'orders' => $orders
       ]);
   }

public function show($orderId)
{
    $order = Order::with(['items.product', 'items.variant', 'shippingAddress'])
        ->where('id', $orderId)
        ->where('user_id', auth()->id())
        ->firstOrFail();

    // Calculate subtotal
    $subtotal = $order->items->sum(fn($item) => $item->quantity * $item->price);

    // Tax (10%)
    $tax = $subtotal * 0.10;

    // Final total
    $finalTotal = $subtotal + $tax;

    // Build delivery timeline steps dynamically
    $timeline = [
        [
            'title' => 'Order Confirmed',
            'message' => 'Your order has been confirmed and payment processed',
            'timestamp' => $order->created_at->format('M d, Y \a\t h:i A'),
            'done' => true,
        ],
        [
            'title' => 'Processing',
            'message' => 'Order is being prepared for shipment',
            'timestamp' => $order->created_at->addMinute(15)->format('M d, Y \a\t h:i A'),
            'done' => in_array($order->status, ['Processing','Delivered']),
        ],
        [
            'title' => 'Shipped',
            'message' => 'Package is on the way',
            'timestamp' => $order->created_at->addHours(2)->format('M d, Y \a\t h:i A'),
            'done' => in_array($order->status, ['Delivered']),
        ],
        [
            'title' => 'Out for Delivery',
            'message' => 'Package is out for delivery',
            'timestamp' => $order->created_at->addHours(20)->format('M d, Y \a\t h:i A'),
            'done' => ($order->status === 'Delivered'),
        ],
        [
            'title' => 'Delivered',
            'message' => 'Package delivered successfully',
            'timestamp' => $order->updated_at->format('M d, Y \a\t h:i A'),
            'done' => ($order->status === 'Delivered'),
        ],
    ];

    return view('frontend.orders.show', compact('order', 'subtotal', 'tax', 'finalTotal', 'timeline'));
}


}
