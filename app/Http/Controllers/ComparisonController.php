<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Comparison;
use App\Models\Product;
use Illuminate\Http\Request;

class ComparisonController extends Controller
{
    public function index()
    {
        Log::info("Fetching comparisons for user", ['user_id' => auth()->id()]);

        $comparisons = Comparison::where('user_id', auth()->id())
            ->latest()
            ->get();

        $comparisons->each(function ($comparison) {
            $comparison->products = Product::whereIn('id', $comparison->product_ids)->get();
        });

        return view('frontend.comparisons-show', compact('comparisons'));
    }

    public function store(Request $request)
    {
        Log::info("Attempting to save comparison", [
            'user_id' => auth()->id(),
            'products' => $request->products
        ]);

        $request->validate([
            'products' => 'required|array|min:2',
            'products.*' => 'integer|exists:products,id',
        ]);

        $comparison = Comparison::create([
            'user_id' => auth()->id(),
            'product_ids' => $request->products,
        ]);

        Log::info("Comparison saved successfully", [
            'comparison_id' => $comparison->id,
            'user_id' => auth()->id()
        ]);

        return response()->json([
            'success' => true,
            'comparison' => $comparison,
        ]);
    }

    public function show($id)
    {
        Log::info("Fetching comparison details", ['id' => $id, 'user_id' => auth()->id()]);

        $comparison = Comparison::where('user_id', auth()->id())
            ->findOrFail($id);

        $products = Product::whereIn('id', $comparison->product_ids)->get();

        return response()->json([
            'id' => $comparison->id,
            'products' => $products
        ]);
    }

    public function destroy($id)
    {
        Log::info("Attempting to delete comparison", ['id' => $id, 'user_id' => auth()->id()]);

        $comparison = Comparison::where('user_id', auth()->id())
            ->findOrFail($id);

        $comparison->delete();

        Log::info("Comparison deleted successfully", ['id' => $id]);

        return response()->json([
            'success' => true,
            'message' => 'Comparison deleted successfully'
        ]);
    }
}
