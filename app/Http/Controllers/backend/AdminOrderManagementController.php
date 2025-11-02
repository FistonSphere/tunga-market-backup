<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

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
}
