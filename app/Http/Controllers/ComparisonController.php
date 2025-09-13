<?php

namespace App\Http\Controllers;

use App\Models\Comparison;
use App\Models\Product;
use Illuminate\Http\Request;

class ComparisonController extends Controller
{

     public function index()
    {
        $comparisons = Comparison::where('user_id', auth()->id())
            ->latest()
            ->get();

        // Optionally eager load product details
        $comparisons->each(function ($comparison) {
            $comparison->products = Product::whereIn('id', $comparison->product_ids)->get();
        });

        return view('frontend.comparisons-show', compact('comparisons'));
    }
    public function store(Request $request)
{
    $request->validate([
        'products' => 'required|array|min:2',
        'products.*' => 'integer|exists:products,id',
    ]);

    $comparison = Comparison::create([
        'user_id' => auth()->id(),
        'product_ids' => $request->products,
    ]);

    return response()->json([
        'success' => true,
        'comparison' => $comparison,
    ]);
}

}
