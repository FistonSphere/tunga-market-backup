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
    Log::info('🔵 Product update started', ['product_id' => $id]);

    $product = Product::findOrFail($id);

    $validated = $request->validate([
        'name'              => 'required|string|max:255',
        'category_id'       => 'nullable|integer',
        'short_description' => 'nullable|string',
        'long_description'  => 'nullable|string',
        'price'             => 'required|numeric',
        'discount_price'    => 'nullable|numeric',
        'currency'          => 'required|string|max:10',
        'sku'               => 'nullable|string|max:100',
        'stock_quantity'    => 'nullable|integer',
        'main_image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'gallery'           => 'nullable',
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

    // ✅ Handle main image upload
    if ($request->hasFile('main_image')) {
        Log::info('🖼 Uploading main image...');
        $file = $request->file('main_image');
        $filename = 'product_main_' . $product->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('products', $filename, 'public');

        // Delete old main image
        if ($product->main_image) {
            $oldPath = str_replace('/storage/', '', parse_url($product->main_image, PHP_URL_PATH));
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
                Log::info('🗑 Deleted old main image', ['path' => $oldPath]);
            }
        }

        $validated['main_image'] = asset('storage/' . $path);
        Log::info('✅ New main image uploaded', ['url' => $validated['main_image']]);
    }

    // ✅ Handle gallery images (Multiple)
    if ($request->hasFile('gallery')) {
        Log::info('🖼 Uploading gallery images...');
        $galleryUrls = [];

        foreach ($request->file('gallery') as $file) {
            $filename = 'product_gallery_' . $product->id . '_' . time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('products/gallery', $filename, 'public');
            $galleryUrls[] = asset('storage/' . $path);
        }

        // Delete old gallery images (if exist)
        if (!empty($product->gallery)) {
            $oldGallery = is_string($product->gallery)
                ? json_decode($product->gallery, true)
                : $product->gallery;

            if (is_array($oldGallery)) {
                foreach ($oldGallery as $oldImage) {
                    $oldPath = str_replace('/storage/', '', parse_url($oldImage, PHP_URL_PATH));
                    if (Storage::disk('public')->exists($oldPath)) {
                        Storage::disk('public')->delete($oldPath);
                        Log::info('🗑 Deleted old gallery image', ['path' => $oldPath]);
                    }
                }
            }
        }

        // ✅ Save gallery as JSON
        $validated['gallery'] = json_encode($galleryUrls);
        Log::info('✅ Gallery saved as JSON', ['count' => count($galleryUrls)]);
    } else {
        Log::warning('⚠️ No gallery images found in request.');
    }

    // ✅ Update slug
    $validated['slug'] = Str::slug($validated['name']);
    Log::info('🔤 Generated slug', ['slug' => $validated['slug']]);

    // ✅ Update product
    $product->update($validated);
    Log::info('✅ Product updated successfully', ['id' => $product->id]);

    return redirect()
        ->route('admin.product.listing')
        ->with('success', '✅ Product updated successfully and gallery images saved.');
}
}
