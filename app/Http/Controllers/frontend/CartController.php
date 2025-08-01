<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
   public function index()
   {
       // Logic to retrieve and display cart items
       return view('frontend.cart'); // Adjust the view name as necessary
   }
}
