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

    if ($request->has('currency')) {
        $query->where('currency', $request->currency);
    }

    if ($request->filled('min_price') && $request->filled('max_price')) {
        $query->whereBetween('price', [$request->min_price, $request->max_price]);
    }

    $products = $query->latest()->paginate(12);

    return response()->json([
        'html' => view('partials.product-grid', compact('products'))->render(),
        'pagination' => view('partials.pagination', compact('products'))->render()
    ]);
}


public function getPriceRange(Request $request)
{
    $currency = $request->get('currency', 'USD');

    $min = Product::where('currency', $currency)->min('price');
    $max = Product::where('currency', $currency)->max('price');

    return response()->json([
        'min' => $min ?? 0,
        'max' => $max ?? 0,
    ]);
}


}
