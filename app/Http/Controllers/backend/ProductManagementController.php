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
    Log::info('🟡 [Product Update] Request started', ['product_id' => $id]);

    try {
        $product = Product::findOrFail($id);
        Log::info('✅ Product found', ['product' => $product->id, 'name' => $product->name]);

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
            'shipping_info'     => 'nullable|array',
            'tags'              => 'nullable|array',
            'status'            => 'nullable|string',
            'brand_id'          => 'nullable|integer',
            'product_type_id'   => 'nullable|integer',
            'unit_id'           => 'nullable|integer',
            'tax_class_id'      => 'nullable|integer',
        ]);

        Log::info('🧾 Validation passed', ['validated_data' => $validated]);

        // 🖼 Handle main image upload with full public URL
        if ($request->hasFile('main_image')) {
            Log::info('🖼 Main image detected for upload.');

            if ($product->main_image && Storage::exists(str_replace(url('/storage'), 'public', $product->main_image))) {
                Storage::delete(str_replace(url('/storage'), 'public', $product->main_image));
                Log::info('🗑 Old main image deleted.', ['path' => $product->main_image]);
            }

            $path = $request->file('main_image')->store('public/products');
            $publicPath = url(Storage::url($path)); // ✅ Convert to full public URL
            $validated['main_image'] = $publicPath;

            Log::info('✅ New main image uploaded', ['path' => $publicPath]);
        }

        // 🖼 Handle multiple gallery images with full URLs
        if ($request->hasFile('gallery')) {
            Log::info('🖼 Gallery images detected.');

            $galleryPaths = [];
            foreach ($request->file('gallery') as $file) {
                $path = $file->store('public/products/gallery');
                $galleryPaths[] = url(Storage::url($path)); // ✅ Convert each to full public URL
                Log::info('✅ Gallery image uploaded', ['path' => end($galleryPaths)]);
            }

            $validated['gallery'] = $galleryPaths;
        }

        // 🧩 Update slug
        $validated['slug'] = Str::slug($validated['name']);
        Log::info('🔤 Slug generated', ['slug' => $validated['slug']]);

        // 🆙 Update product record
        $product->update($validated);
        Log::info('✅ Product updated successfully in database.', ['product_id' => $product->id]);

        return redirect()->route('admin.product.listing')
            ->with('success', '✅ Product details updated successfully.');

    } catch (\Exception $e) {
        Log::error('❌ Product update failed', [
            'product_id' => $id,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        return back()->with('error', 'Something went wrong while updating the product.');
    }

}
}
