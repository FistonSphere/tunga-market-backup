<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
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

    $products = Product::with(['category', 'brand'])
    ->whereIn('id', $ids)->get();

    return response()->json($products);
}

    public function showProduct($request, $sku)
    {
        // Logic to show a specific product
        $product = Product::where('sku', $sku)->firstOrFail();
        return view('frontend.product-view', compact('product')); // Adjust the view name as necessary
    }

    public function getCategoriesWithProductCount()
{
    $categories = Category::withCount('products')
        ->having('products_count', '>', 0)
        ->orderByDesc('products_count')
        ->get();

    return response()->json($categories);
}


    public function filterProducts(Request $request)
{
    $query = Product::with('brand');

    if ($request->has('categories') && is_array($request->categories)) {
        $query->whereIn('category_id', $request->categories);
    }

    $products = $query->latest()->paginate(12);

    return response()->json([
        'html' => view('partials.product-grid', compact('products'))->render(),
        'pagination' => view('partials.pagination', compact('products'))->render()
    ]);
}

public function filterByPrice(Request $request)
{
    $currency = $request->currency;
    $minPrice = $request->min_price;
    $maxPrice = $request->max_price;

    // Start query
    $query = Product::with('brand', 'category');

    if ($currency && in_array($currency, ['$', 'RWF'])) {
        $query->where('currency', $currency);
    }

    if ($minPrice !== null && $maxPrice !== null) {
        $query->whereBetween('price', [$minPrice, $maxPrice]);
    }

    // Paginate for better handling with partials
    $products = $query->paginate(12);

    return response()->json([
        'html' => view('partials.product-grid', compact('products'))->render(),
        'pagination' => view('partials.pagination', compact('products'))->render()
    ]);
}



}
