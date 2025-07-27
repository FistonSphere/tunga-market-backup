<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductListingController extends Controller
{
    public function index()
    {
        // Logic to retrieve and display products
        return view('frontend.product-list'); // Adjust the view name as necessary
    }
}
