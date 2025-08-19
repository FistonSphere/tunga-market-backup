<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = Cart::with('product')
            ->where('user_id', Auth::id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }
        return view('frontend.checkout', compact('cartItems')); // Adjust the view name as necessary
    }

     public function storeShipping(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'city'    => 'required|string|max:255',
            'country' => 'required|string|max:100',
            'phone'   => 'required|string|max:20',
        ]);

        session(['checkout.shipping' => $request->all()]);

        return redirect()->route('checkout.index')->with('step', 2);
    }

    // Step 3: Store Payment
    public function storePayment(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        session(['checkout.payment' => $request->all()]);

        return redirect()->route('checkout.index')->with('step', 3);
    }
}
