<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function showProduct($sku)
{
    // Fetch product with category in one query
    $product = Product::with('category')
        ->where('sku', $sku)
        ->where('status', 'active')
        ->firstOrFail();

    // Increment product views
    $product->increment('views_count');

    // Fetch related products (same category, exclude current product)
    $relatedProducts = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id)
        ->latest()
        ->take(12)
        ->get();
    // If no related products, fallback to most viewed products
    if ($relatedProducts->isEmpty()) {
        $relatedProducts = Product::where('id', '!=', $product->id)
            ->orderByDesc('views_count')
            ->take(12)
            ->get();

        $relatedTitle = 'Products You May Also Like';
    }
    else {
    $relatedTitle = 'Related Products';
    }
    // Fetch only verified reviews with user eager loaded
    $reviews = Review::with('user')
        ->where('product_id', $product->id)
        ->where('verified', true)
        ->latest()
        ->get();

    // Calculate average rating (rounded to 1 decimal)
    $averageRating = round($reviews->avg('rating') ?? 0, 1);

    // Count total reviews
    $reviewsCount = $reviews->count();

    // Build rating breakdown (count per star 1–5, default 0)
    $ratingBreakdown = collect(range(1, 5))
        ->mapWithKeys(fn($star) => [$star => $reviews->where('rating', $star)->count()]);

    // Transform reviews for frontend (ensure safe user data)
    $product->reviews_display = $product->reviews
        ->where('verified', true)
        ->map(function ($review) {
            return (object)[
                'user' => (object)[
                    'name'   => $review->user->first_name ?? 'Anonymous',
                    'avatar' => $review->user->profile_picture ?? asset('assets/images/avatar.png'),
                ],
                'rating'        => $review->rating,
                'comment'       => $review->comment,
                'created_at'    => $review->created_at,
                'verified'      => true,
                'helpful_count' => $review->helpful_count ?? 0,
            ];
        })
        ->values();
        $userId = Auth::id();
        $userHasPurchased = DB::table('order_items')
        ->join('orders', 'order_items.order_id', '=', 'orders.id')
        ->where('orders.user_id', $userId)
        ->where('order_items.product_id', $product->id)
        ->exists();
    return view('frontend.product-view', compact('product', 'relatedProducts', 'relatedTitle','reviewsCount','userHasPurchased'));
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


public function filter(Request $request)
{
    $query = Product::query();

    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    if ($request->filled('product_id')) {
        $query->where('id', $request->product_id);
    }

    if ($request->filled('supplier_id')) {
        $query->where('supplier_id', $request->supplier_id);
    }

    // Add other filters if needed (price, brand, etc.)

    $products = $query->paginate(20);

     return response()->json([
        'html' => view('partials.product-grid', compact('products'))->render(),
        'pagination' => view('partials.pagination', compact('products'))->render()
    ]);
}



}
