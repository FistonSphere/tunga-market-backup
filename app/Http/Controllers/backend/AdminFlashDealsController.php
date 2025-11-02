<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\FlashDeal;
use App\Models\Product;
use Illuminate\Http\Request;

class AdminFlashDealsController extends Controller
{
   public function index(){

    $flashDeals= FlashDeal::paginate(8);
    return view('admin.flash-deals.index', compact('flashDeals'));
    
   }

   public function edit($id){
     $flashDeal = FlashDeal::with('product')->findOrFail($id);
     $products= Product::where('status', 'active')->get(); 
        return view('admin.flash-deals.edit', compact('flashDeal','products'));
   }
   public function update(Request $request, $id)
{
    $flashDeal = FlashDeal::findOrFail($id);

    $validated = $request->validate([
        'product_id' => 'required|exists:products,id',
        'flash_price' => 'required|numeric|min:0',
        'discount_percent' => 'nullable|integer|min:0|max:100',
        'stock_limit' => 'nullable|integer|min:0',
        'start_time' => 'required|date',
        'end_time' => 'required|date|after:start_time',
        'is_active' => 'required|string|in:Active,Inactive',
    ]);

    $flashDeal->update([
        'product_id' => $validated['product_id'],
        'flash_price' => $validated['flash_price'],
        'discount_percent' => $validated['discount_percent'] ?? 0,
        'stock_limit' => $validated['stock_limit'] ?? null,
        'start_time' => $validated['start_time'],
        'end_time' => $validated['end_time'],
        'is_active' => $request->has('is_active') ? 'Active' : 'Inactive',
    ]);

    return redirect()->route('admin.flashDeals.index')
        ->with('success', 'Flash Deal updated successfully!');
}

 public function destroy($id)
{
    $FlashDeal = FlashDeal::findOrFail($id);

    $FlashDeal->delete();

    return redirect()->route('admin.flashDeals.index')->with('success', 'flash deal deleted successfully!');
}
}
