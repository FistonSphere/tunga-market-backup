<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
   public function index()
   {
    $orderTracks = OrderItem::with('order','product')->where('user_id', auth()->id())->get();
       // Logic to show the order tracking page
       return view('frontend.order-tracking',[
        'orderTracks' => $orderTracks
       ]); // Adjust the view name as necessary
   }
}
