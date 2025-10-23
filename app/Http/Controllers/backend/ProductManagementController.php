<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\Log;
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

    $validated = $request->validate([
        'name'              => 'required|string|max:255',
        'category_id'       => 'nullable|integer',
        'short_description' => 'nullable|string',
        'long_description'  => 'nullable|string',
        'price'             => 'required|numeric',
        'discount_price'    => 'nullable|numeric',
        'currency'          => 'Rwf',
        'sku'               => 'nullable|string|max:100',
        'stock_quantity'    => 'nullable|integer',
        'main_image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'gallery.*'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'features'          => 'nullable|array',
        'specifications'    => 'nullable|array',
        'tags'              => 'nullable|array',
        'status'            => 'nullable|string',
        'brand_id'          => 'nullable|integer',
        'product_type_id'   => 'nullable|integer',
        'unit_id'           => 'nullable|integer',
        'tax_class_id'      => 'nullable|integer',
    ]);

    // 🖼 Handle main image
    if ($request->hasFile('main_image')) {
        $file = $request->file('main_image');
        $filename = 'product_main_' . $product->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('products', $filename, 'public');

        // Delete old main image if exists
        if ($product->main_image && Storage::disk('public')->exists(str_replace('/storage/', '', parse_url($product->main_image, PHP_URL_PATH)))) {
            Storage::disk('public')->delete(str_replace('/storage/', '', parse_url($product->main_image, PHP_URL_PATH)));
        }

        // Save full public URL
        $validated['main_image'] = asset('storage/' . $path);
    }

    // 🖼 Handle multiple gallery images
    if ($request->hasFile('gallery')) {
        $galleryUrls = [];
        foreach ($request->file('gallery') as $file) {
            $filename = 'product_gallery_' . $product->id . '_' . time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('products/gallery', $filename, 'public');
            $galleryUrls[] = asset('storage/' . $path);
        }

        // Optionally delete old gallery if needed
        if (is_array($product->gallery)) {
            foreach ($product->gallery as $oldImage) {
                $oldPath = str_replace('/storage/', '', parse_url($oldImage, PHP_URL_PATH));
                if (Storage::disk('public')->exists($oldPath)) {
                    Storage::disk('public')->delete($oldPath);
                }
            }
        }

        $validated['gallery'] = $galleryUrls;
    }

    // Update product slug if name changed
    $validated['slug'] = Str::slug($validated['name']);

    $product->update($validated);

    return redirect()->route('admin.product.listing')
        ->with('success', '✅ Product details updated successfully and images stored with public URLs.');
}
}
