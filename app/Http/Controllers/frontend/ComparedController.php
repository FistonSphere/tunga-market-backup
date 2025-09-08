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
    foreach ($products as $product) {
        $product->average_rating = $product->reviews->avg('rating') ?? 0;
    }
    return view('frontend.compare', [
        'totalProducts' => $totalProducts,
        'formattedTotal' => $formattedTotal,
        'products' => $products,
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
