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

    public function showProduct()
    {
        // Logic to show a specific product
        return view('frontend.product-view'); // Adjust the view name as necessary
    }
}
