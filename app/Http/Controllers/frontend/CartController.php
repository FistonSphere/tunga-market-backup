<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
   public function index()
   {
    //    $carts= Cart::auth()->user()->carts;

       return view('frontend.cart');
   }
}
