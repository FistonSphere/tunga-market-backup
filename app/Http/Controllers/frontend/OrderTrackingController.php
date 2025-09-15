<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
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
}
