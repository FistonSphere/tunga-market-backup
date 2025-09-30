<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
         $categories = Category::withCount(['products' => function($query) {
            $query->where('status', 'active');
        }])
        ->with(['products' => function($query) {
            $query->select('id','category_id','views_count','sales_count');
        }])
        ->where('is_active', 1)
        ->get();

        // Add calculated growth percentage
        $categories->map(function ($category) {
            $totalViews = $category->products->sum('views_count');
            $totalSales = $category->products->sum('sales_count');

            $base = $totalViews;
            dd($base);
            $category->growth = $base > 0 ? min(100, round(($totalSales / $base) * 100)) : 0;

            return $category;
        });
        return view('frontend.home', compact('categories'));
    }

    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products()->where('status', 'active')->paginate(12);

        return view('categories.show', compact('category', 'products'));
    }
}
