<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
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
        $categories = Category::withCount('products')
            ->having('products_count', '>', 0)
            ->orderByDesc('products_count')
            ->get();
        return view('frontend.product-list', compact('products','categories')); // Adjust the view name as necessary
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
         $product->increment('view_count');
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
    $currency = $request->get('currency');
    $minPrice = $request->get('min_price');
    $maxPrice = $request->get('max_price');

    $query = Product::with('brand', 'category');

    if ($currency && in_array($currency, ['$', 'RWF'])) {
        $query->where('currency', $currency);
    }

    if ($minPrice !== null && $maxPrice !== null) {
        $query->whereBetween('price', [$minPrice, $maxPrice]);
    }

    $products = $query->latest()->paginate(12);

    return response()->json([
        'html' => view('partials.product-grid', compact('products'))->render(),
        'pagination' => view('partials.pagination', compact('products'))->render()
    ]);
}

public function sortProducts(Request $request)
{
    $sort = $request->get('sort', 'best');

    $query = Product::with('brand', 'category');

    switch ($sort) {
        case 'price_asc':
            $query->orderBy('price', 'asc');
            break;
        case 'price_desc':
            $query->orderBy('price', 'desc');
            break;
        case 'newest':
            $query->orderBy('created_at', 'desc');
            break;
        case 'top_viewed':
            $query->orderBy('views_count', 'desc'); // use your actual column name
            break;
        default:
            $query->latest();
    }

    // paginate and append the 'sort' param so links keep it
    $products = $query->paginate(12)->appends(['sort' => $sort]);

    return response()->json([
        'html' => view('partials.product-grid', compact('products'))->render(),
        'pagination' => view('partials.pagination', compact('products'))->render()
    ]);
}

public function brandList()
{
    // Get only brands that have products in stock
    $brands = Brand::whereHas('products', function($q){
        $q->where('stock_quantity', '>', 0);
    })->select('id', 'name')->get();

    return response()->json($brands);
}

public function brandFilter(Request $request)
{
    $query = Product::query();

    // Brand filter
    if ($request->filled('brand_ids')) {
        $brandIds = (array) $request->input('brand_ids'); // cast to array
        $query->whereIn('brand_id', $brandIds);
    }

    // Availability filter
    if ($request->boolean('in_stock')) {
        $query->where('stock_quantity', '>', 0);
    }

    // Example sorting logic
    if ($request->filled('sort')) {
        $sort = $request->sort;
        if ($sort == 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort == 'price_desc') {
            $query->orderBy('price', 'desc');
        } elseif ($sort == 'latest') {
            $query->orderBy('created_at', 'desc');
        }
    }

    $products = $query->paginate(12); // use paginate to support pagination partials

    return response()->json([
        'html' => view('partials.product-grid', compact('products'))->render(),
        'pagination' => view('partials.pagination', compact('products'))->render()
    ]);
}

public function getTrendingSuggestions()
{
    $trendingProducts = Product::select('id', 'name','sku')
        ->orderByDesc('views_count')
        ->limit(10)
        ->get();

    return response()->json($trendingProducts);
}



public function search(Request $request)
{
    $query = Product::query();

    if ($request->filled('q')) {
        $search = $request->q;
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('short_description', 'like', "%{$search}%")
              ->orWhereHas('category', function($q2) use ($search) {
                  $q2->where('name', 'like', "%{$search}%");
              })
              ->orWhereHas('brand', function($q3) use ($search) {
                  $q3->where('name', 'like', "%{$search}%");
              });
        });
    }

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    $products = $query->paginate(20);

    $html = view('partials.product-grid', compact('products'))->render();
    $pagination = view('partials.pagination', compact('products'))->render();

    return response()->json([
        'html' => $html,
        'pagination' => $pagination,
    ]);
}


}
