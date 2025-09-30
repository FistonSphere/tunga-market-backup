<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function view($slug)
    {
        // fetch category
        $category = Category::where('slug', $slug)->firstOrFail();

        // fetch products under this category
        $products = Product::where('category_id', $category->id)
            ->where('status', 'active')
            ->latest()
            ->paginate(12);
             $categories = Category::withCount('products')
            ->having('products_count', '>', 0)
            ->orderByDesc('products_count')
            ->get();

        return view('frontend.categories-view', compact('category', 'products','categories'));
    }

    public function filter(Request $request, $slug)
{
    $category = Category::where('slug', $slug)->firstOrFail();

    $query = $category->products()->where('status', 'active');

    // Filters
    if ($request->filled('currency')) {
        $query->where('currency', $request->currency);
    }
    if ($request->filled('min_price')) {
        $query->where('price', '>=', $request->min_price);
    }
    if ($request->filled('max_price')) {
        $query->where('price', '<=', $request->max_price);
    }

    $products = $query->paginate(12);

    // Render only product grid partial
    $html = view('partials.product-grid-category', compact('products'))->render();
    $pagination = view('partials.pagination-category', compact('products'))->render();

    return response()->json([
        'html' => $html,
        'pagination' => $products->links()->toHtml(),
    ]);
}

}
