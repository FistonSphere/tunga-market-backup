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
    $order = Order::with(['items.product', 'items.variant']) // Load all order items with product + variant
        ->where('id', $orderId)
        ->where('user_id', auth()->id()) // Ensure it's the user's order
        ->firstOrFail(); // 404 if not found

    return view('frontend.orders.show', compact('order'));
}
}
