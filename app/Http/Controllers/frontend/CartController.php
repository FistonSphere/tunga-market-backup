<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
   public function index()
   {
    $cartItems = Cart::with('product')
        ->where('user_id', Auth::id())
        ->get();

    // Calculate subtotal
    $subtotal = $cartItems->sum(function ($item) {
        return $item->price * $item->quantity;
    });

       return view('frontend.cart',compact('cartItems', 'subtotal'));
   }
}
