<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
public function suggestions(Request $request)
    {
        $query = $request->get('q', '');

        if (strlen($query) < 2) {
            return response()->json([
                'products' => [],
                'categories' => []
            ]);
        }

        // Search products by name
        $products = Product::where('name', 'like', "%{$query}%")
            ->select('id', 'name')
            ->limit(5)
            ->get();

        // Search categories by name
        $categories = Category::where('name', 'like', "%{$query}%")
            ->select('id', 'name')
            ->limit(5)
            ->get();


        return response()->json([
            'products' => $products,
            'categories' => $categories,
        ]);
    }

}
