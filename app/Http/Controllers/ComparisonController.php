<?php

namespace App\Http\Controllers;

use App\Models\Comparison;
use Illuminate\Http\Request;

class ComparisonController extends Controller
{
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
