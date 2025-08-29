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
}
