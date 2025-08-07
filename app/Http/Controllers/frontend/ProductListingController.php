<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductListingController extends Controller
{
    public function index()
    {
        // Logic to retrieve and display products
        $products = Product::with(['category', 'brand'])
        ->where('status', 'active')
        ->orderBy('created_at', 'desc')
        ->paginate(9);
        return view('frontend.product-list', compact('products')); // Adjust the view name as necessary
    }

    public function compare(Request $request)
{
    $ids = $request->input('products', []);

    $products = Product::whereIn('id', $ids)->get();

    return response()->json($products);
}

    public function showProduct($request, $sku)
    {
        // Logic to show a specific product
        $product = Product::where('sku', $sku)->firstOrFail();
        return view('frontend.product-view', compact('product')); // Adjust the view name as necessary
    }
}
