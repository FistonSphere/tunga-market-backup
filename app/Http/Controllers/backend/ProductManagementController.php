<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductManagementController extends Controller
{
   public function index(){
   $products= Product::with('category','brand','units')->paginate('15');
 
    return view('admin.products.product-list', compact('products'));
   }

   public function show($id)
{
    $product = Product::with(['category', 'brand', 'units'])->findOrFail($id);
    return view('admin.products.show', compact('product'));
}


public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    /**
     * Update the product details.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'              => 'required|string|max:255',
            'category_id'       => 'required|exists:categories,id',
            'brand_id'          => 'nullable|exists:brands,id',
            'price'             => 'required|numeric|min:0',
            'stock_quantity'    => 'required|integer|min:0',
            'short_description' => 'nullable|string',
            'long_description'  => 'nullable|string',
            'main_image'        => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        // Handle image upload
        if ($request->hasFile('main_image')) {
            if ($product->main_image && file_exists(public_path($product->main_image))) {
                unlink(public_path($product->main_image));
            }

            $image = $request->file('main_image');
            $filename = 'product_' . time() . '.' . $image->getClientOriginalExtension();
            $path = $image->move(public_path('uploads/products'), $filename);
            $product->main_image = 'uploads/products/' . $filename;
        }

        // Update basic fields
        $product->update([
            'name'              => $request->name,
            'slug'              => Str::slug($request->name),
            'category_id'       => $request->category_id,
            'brand_id'          => $request->brand_id,
            'price'             => $request->price,
            'stock_quantity'    => $request->stock_quantity,
            'short_description' => $request->short_description,
            'long_description'  => $request->long_description,
        ]);

        return redirect()->route('admin.product.listing')
            ->with('success', 'Product details updated successfully.');
    }
}
