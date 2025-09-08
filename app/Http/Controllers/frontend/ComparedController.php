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
 $productDatabase = [];

        foreach ($products as $product) {
            $avgRating = round($product->reviews->avg('rating') ?? 0, 1);
            $reviewsCount = $product->reviews->count();

            $productDatabase[$product->slug] = [
                'ProductId'     => $product->id,
                'name'   => $product->name,
                'image'  => $product->main_image,
                'price'  => $product->discount_price ?? $product->price,
                'originalPrice' => $product->discount_price ? $product->price : null,
                'rating' => $avgRating,
                'reviews'=> $reviewsCount,
                'supplier' => 'Tunga Market', // adjust if you have supplier relation
                'category'=> $product->category->name ?? 'N/A',
                'features'=> $this->mapFeatures($product),
                'scores'  => [
                    'overall' => $avgRating,
                    'value'   => rand(3, 5),     // placeholder (can improve later)
                    'quality' => rand(3, 5),
                    'delivery'=> rand(3, 5),
                ],
            ];
        }
    
    return view('frontend.compare', [
        'totalProducts' => $totalProducts,
        'formattedTotal' => $formattedTotal,
        'products' => $products,
        'productDatabase' => json_encode($productDatabase),
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
 private function mapFeatures($product)
    {
        // If features are stored as JSON in DB
        if ($product->features) {
            return json_decode($product->features, true);
        }

        // Example fallback features
        return [
            'Views'       => $this->formatViews($product->views_count),
            'Sales'       => $this->formatViews($product->sales_count),
            'Stock'       => $product->stock_quantity,
            'Warranty'    => '1 year',
        ];
    }

    /**
     * Format views/sales into K, M, B
     */
    private function formatViews($number)
    {
        if ($number >= 1000000000) {
            return number_format($number / 1000000000, 1) . 'B';
        } elseif ($number >= 1000000) {
            return number_format($number / 1000000, 1) . 'M';
        } elseif ($number >= 1000) {
            return number_format($number / 1000, 1) . 'K';
        }
        return (string) $number;
    }

}
