<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ComparedController extends Controller
{
    public function index()
{
    $totalProducts = Product::where('status', 'active')->count();
    // Format the number into K/M/B
    $formattedTotal = $this->formatNumber($totalProducts);
    $products = Product::with('category','reviews')->where('status', 'active')->get();
    foreach ($products as $product) {
        $product->formatted_views = $this->formatNumber($product->views_count);
    }
$productsArray = Product::with(['category', 'reviews'])
        ->where('status', 'active')
        ->get()
        ->map(function ($product) {
            return [
                'id' => $product->id,
                'name' => $product->name,
                'image' => $product->main_image,
                'price' => $product->discount_price ?? $product->price,
                'originalPrice' => $product->price,
                'rating' => round($product->reviews->avg('rating') ?? 0, 1),
                'reviews' => $product->reviews->count(),
                'supplier' => 'Tunga Market', // or $product->supplier if you have it
                'category' => $product->category->name ?? 'N/A',
                'features' => [
                    'Views' => $product->formatted_views,
                    // add other dynamic specs if available
                ],
                'scores' => [
                    'overall' => round($product->reviews->avg('rating') ?? 0, 1),
                    'value' => rand(3, 5),     // placeholder → can compute logic
                    'quality' => rand(3, 5),   // placeholder
                    'delivery' => rand(3, 5),  // placeholder
                ]
            ];
        });
    
    return view('frontend.compare', [
        'totalProducts' => $totalProducts,
        'formattedTotal' => $formattedTotal,
        'products' => $products,
        'productsArray' => $productsArray
    ]);
}

private function formatNumber($num)
{
    if ($num >= 1000000000) {
        return round($num / 1000000000, 1) . 'B+';
    }
    if ($num >= 1000000) {
        return round($num / 1000000, 1) . 'M+';
    }
    if ($num >= 1000) {
        return round($num / 1000, 1) . 'K+';
    }
    return $num;
}
function formatViews($number) {
    if ($number >= 1000000000) {
        return number_format($number / 1000000000, 1) . 'B';
    } elseif ($number >= 1000000) {
        return number_format($number / 1000000, 1) . 'M';
    } elseif ($number >= 1000) {
        return number_format($number / 1000, 1) . 'K';
    } else {
        return $number;
    }
}

}
