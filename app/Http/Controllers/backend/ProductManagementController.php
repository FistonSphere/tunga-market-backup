<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\ProductType;
use App\Models\TaxClass;
use App\Models\Unit;
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
        $taxClasses = TaxClass::all();
        $units = Unit::all();
        $productTypes = ProductType::all();
        return view('admin.products.edit', compact('product', 'categories', 'brands','taxClasses','units','productTypes'));
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
        'brand_id'          => 'nullable|integer',
        'tax_class_id'      => 'nullable|integer',
        'unit_id'           => 'nullable|integer',
        'product_type_id'   => 'nullable|integer',
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
        'video_url'         => 'nullable|string|max:255',
        'status'            => 'required|string|in:active,inactive,draft',
        'specifications'    => 'nullable|string',
        'features'          => 'nullable|string',
        'shipping_info'     => 'nullable|string',
        'tags'              => 'nullable|string',
    ]);

    // ✅ Parse JSON-like fields
    foreach (['specifications', 'features', 'shipping_info', 'tags'] as $jsonField) {
        if (!empty($validated[$jsonField])) {
            $decoded = json_decode($validated[$jsonField], true);
            $validated[$jsonField] = json_last_error() === JSON_ERROR_NONE ? json_encode($decoded) : json_encode(array_map('trim', explode(',', $validated[$jsonField])));
        }
    }

    // ✅ Handle checkboxes
    foreach (['is_featured', 'is_new', 'is_best_seller', 'has_3d_model'] as $flag) {
        $validated[$flag] = $request->has($flag) ? 1 : 0;
    }

    // --- Handle specifications ---
    // Specifications
$specifications = [];
if ($request->filled('specifications')) {
    $pairs = explode(',', $request->specifications);
    foreach ($pairs as $pair) {
        if (strpos($pair, ':') !== false) {
            [$key, $value] = explode(':', $pair, 2);
            $specifications[trim($key)] = trim($value);
        }
    }
}
$validated['specifications'] = json_encode($specifications, JSON_UNESCAPED_SLASHES);

// Features
$features = [];
if ($request->filled('features')) {
    $features = array_map('trim', explode(',', $request->features));
}
$validated['features'] = json_encode($features, JSON_UNESCAPED_SLASHES);

// Shipping Info
$validated['shipping_info'] = $request->input('shipping_info', null);

    // ✅ Handle main image upload
    if ($request->hasFile('main_image')) {
        $file = $request->file('main_image');
        $filename = 'product_main_' . $product->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('products', $filename, 'public');

        if ($product->main_image) {
            $oldPath = str_replace('/storage/', '', parse_url($product->main_image, PHP_URL_PATH));
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        $validated['main_image'] = asset('storage/' . $path);
    }

    // ✅ Handle gallery
    $existingGallery = json_decode($product->gallery, true) ?? [];
    if (!is_array($existingGallery)) $existingGallery = [];

    $newGalleryUrls = [];
    if ($request->hasFile('gallery')) {
        foreach ($request->file('gallery') as $file) {
            if ($file && $file->isValid()) {
                $filename = 'product_gallery_' . $product->id . '_' . time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $path = $file->storeAs('products/gallery', $filename, 'public');
                $newGalleryUrls[] = asset('storage/' . $path);
            }
        }
    }

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
    }

    $finalGallery = array_merge($existingGallery, $newGalleryUrls);
    $finalGallery = array_filter($finalGallery, fn($item) => is_string($item) && preg_match('/^https?:\/\//', $item));
    $validated['gallery'] = json_encode(array_values($finalGallery));

    // ✅ Slug
    $validated['slug'] = Str::slug($validated['name']);

    $product->update($validated);

    Log::info('✅ Product updated successfully', [
        'id' => $product->id,
        'gallery_count' => count($finalGallery),
        'updated_fields' => array_keys($validated),
    ]);

    return redirect()
        ->route('admin.product.listing')
        ->with('success', '✅ Product updated successfully.');
}



}
