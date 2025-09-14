<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductDiscoveryHubController extends Controller
{
   public function index(Request $request)
    {
        // Grab possible filters from query
        $categoryId = $request->query('category_id');
        $productId = $request->query('product_id');
        // other filters ...

        // If you want, you can fetch initial products filtered or all
        $query = Product::query();

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }
        if ($productId) {
            $query->where('id', $productId);
        }
        // add other initial filters if needed

        // Let's not paginate here if you're using AJAX to load via filter endpoint,
        // but we can send empty or some default product list
        $products = $query->paginate(20)->appends($request->all());

        // categories list for filter dropdown etc
        $categories = Category::all();

        return view('frontend.product-list', [
            'categories' => $categories,
            'selectedCategoryId' => $categoryId,
            'products' => $products
        ]);
    }
}
