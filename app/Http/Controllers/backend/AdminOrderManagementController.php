<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderManagementController extends Controller
{
   public function Orderlist(){
 $orders= Order::with('user','items','shippingAddress','payment');
    return view('admin.orders.index', compact('orders'));
   }
}
