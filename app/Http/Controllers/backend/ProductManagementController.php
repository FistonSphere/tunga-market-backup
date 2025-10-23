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
        'currency'          => 'nullable|string|max:10',
        'sku'               => 'nullable|string|max:100',
        'stock_quantity'    => 'nullable|integer',
        'main_image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'gallery'           => 'nullable',
        'gallery.*'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
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

    // ✅ Handle existing gallery
    $existingGallery = json_decode($product->gallery, true) ?? [];
    if (!is_array($existingGallery)) $existingGallery = [];

    $newGalleryUrls = [];

    // ✅ Handle new gallery uploads
    if ($request->hasFile('gallery')) {
        Log::info('🖼 New gallery images uploaded');
        foreach ($request->file('gallery') as $file) {
            if ($file && $file->isValid()) {
                $filename = 'product_gallery_' . $product->id . '_' . time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $path = $file->storeAs('products/gallery', $filename, 'public');
                $newGalleryUrls[] = asset('storage/' . $path);
            }
        }
    }

    // ✅ Handle submitted gallery input (existing images)
    if ($request->filled('gallery')) {
        $submittedGallery = $request->gallery;

        if (is_string($submittedGallery)) {
            $decoded = json_decode($submittedGallery, true);
            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                $existingGallery = $decoded;
            }
        } elseif (is_array($submittedGallery)) {
            $existingGallery = $submittedGallery;
        }

        Log::info('🧩 Updated existing gallery from gallery input', ['gallery' => $existingGallery]);
    }

    // ✅ Merge existing + new uploads
    $finalGallery = array_merge($existingGallery, $newGalleryUrls);

    // ✅ Clean and keep only valid URL strings
    $finalGallery = array_filter($finalGallery, function ($item) {
        return is_string($item) && preg_match('/^https?:\/\//', $item);
    });

    // ✅ Reindex for clean JSON
    $validated['gallery'] = json_encode(array_values($finalGallery));

    // ✅ Update slug
    $validated['slug'] = Str::slug($validated['name']);

    // ✅ Update product
    $product->update($validated);

    Log::info('✅ Product updated successfully', ['id' => $product->id, 'gallery_count' => count($finalGallery)]);

    return redirect()
        ->route('admin.product.listing')
        ->with('success', '✅ Product updated successfully and gallery images saved.');
}


}
