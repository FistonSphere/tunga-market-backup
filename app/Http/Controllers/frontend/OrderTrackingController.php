<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderTrackingController extends Controller
{
   public function index()
   {
       // Logic to show the order tracking page
       return view('frontend.order-tracking'); // Adjust the view name as necessary
   }
}
