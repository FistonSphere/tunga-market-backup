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

   public function show(Order $order)
{
    // Ensure the logged-in user owns this order
    if ($order->user_id !== auth()->id()) {
        abort(403, 'Unauthorized access to this order.');
    }

    // Load related data if needed (items, products, etc.)
    $order->load('items.product', 'supplier'); // Assuming supplier relation exists

    return view('orders.show', compact('order'));
}
}
