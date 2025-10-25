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

    // ✅ Parse JSON-like fields (features/specifications)
    foreach (['specifications', 'features', 'shipping_info', 'tags'] as $jsonField) {
        if (!empty($validated[$jsonField])) {
            $decoded = json_decode($validated[$jsonField], true);
            $validated[$jsonField] = json_last_error() === JSON_ERROR_NONE
                ? json_encode($decoded)
                : json_encode(array_map('trim', explode(',', $validated[$jsonField])));
        }
    }

    // ✅ Handle checkboxes
    foreach (['is_featured', 'is_new', 'is_best_seller', 'has_3d_model'] as $flag) {
    $validated[$flag] = $request->has($flag) ? 1 : 0;
}


    // ✅ Specifications and features conversion
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

    $features = [];
    if ($request->filled('features')) {
        $features = array_map('trim', explode(',', $request->features));
    }
    $validated['features'] = json_encode($features, JSON_UNESCAPED_SLASHES);

    $validated['shipping_info'] = $request->input('shipping_info', null);

    // ✅ Handle main image
    if ($request->hasFile('main_image')) {
        $file = $request->file('main_image');
        $filename = 'product_main_' . $product->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('products', $filename, 'public');

        // delete old main image if exists
        if ($product->main_image) {
            $oldPath = str_replace('/storage/', '', parse_url($product->main_image, PHP_URL_PATH));
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        $validated['main_image'] = asset('storage/' . $path);
    }


// ✅ Define local helper closure (works within this method)
$shortPath = function ($path) {
    if (!$path) return '';
    $segments = explode('/', parse_url($path, PHP_URL_PATH));
    return implode('/', array_slice($segments, -2));
};

// ✅ Handle gallery intelligently
$existingGallery = json_decode($product->gallery, true) ?? [];
if (!is_array($existingGallery)) $existingGallery = [];

// 1️⃣ Get submitted gallery from hidden field (after user edits)
$submittedGallery = $request->input('gallery');
Log::info('📤 Submitted gallery (raw)', [
    'short' => is_array($submittedGallery)
        ? array_map($shortPath, $submittedGallery)
        : $shortPath($submittedGallery)
]);

$frontendGallery = [];

if ($submittedGallery) {
    if (is_string($submittedGallery)) {
        $decoded = json_decode($submittedGallery, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            $frontendGallery = $decoded;
        }
        Log::info('🧩 Decoded gallery', [
            'count' => count($frontendGallery),
            'short' => array_map($shortPath, $frontendGallery)
        ]);
    } elseif (is_array($submittedGallery)) {
        $frontendGallery = $submittedGallery;
        Log::info('🧩 Submitted gallery (array)', [
            'count' => count($frontendGallery),
            'short' => array_map($shortPath, $frontendGallery)
        ]);
    }
}

$frontendGallery = array_filter($frontendGallery, fn($url) => is_string($url) && !empty($url));

// 2️⃣ Load existing gallery from DB
Log::info('🗂 Existing gallery', [
    'count' => count($existingGallery),
    'short' => array_map($shortPath, $existingGallery)
]);

// 3️⃣ Detect removed images
$removedImages = array_diff($existingGallery, $frontendGallery);
Log::info('❌ To remove', ['short' => array_map($shortPath, $removedImages)]);

foreach ($removedImages as $oldImage) {
    $oldPath = str_replace('/storage/', '', parse_url($oldImage, PHP_URL_PATH));
    if (Storage::disk('public')->exists($oldPath)) {
        Storage::disk('public')->delete($oldPath);
        Log::info('🗑 Deleted old image', ['short' => $shortPath($oldPath)]);
    }
}

// 4️⃣ Handle new uploads
$newGalleryUrls = [];
if ($request->hasFile('gallery')) {
    $files = $request->file('gallery');
    Log::info('📸 New gallery files', ['count' => count($files)]);

    foreach ($files as $file) {
        if ($file && $file->isValid()) {
            $filename = 'product_gallery_' . $product->id . '_' . uniqid() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $path = $file->storeAs('products/gallery', $filename, 'public');
            $url = asset('storage/' . $path);
            $newGalleryUrls[] = $url;

            Log::info('✅ Uploaded new image', ['short' => $shortPath($url)]);
        }
    }
} else {
    Log::info('🛑 No new files uploaded.');
}

// 5️⃣ Merge existing (kept) + new uploads
$finalGallery = array_merge($frontendGallery, $newGalleryUrls);
Log::info('🔗 Combined gallery (before cleanup)', ['short' => array_map($shortPath, $finalGallery)]);

// 6️⃣ Final cleanup & save
$finalGallery = array_values(array_unique(array_filter($finalGallery, function ($url) {
    if (!is_string($url) || empty($url)) return false;
    return preg_match('/^https?:\/\/|^\/storage\//', $url); // keep valid HTTP or storage URLs only
})));

Log::info('✅ Final gallery saved', ['count' => count($finalGallery), 'short' => array_map($shortPath, $finalGallery)]);

$validated['gallery'] = json_encode($finalGallery);

// ✅ Update slug
$validated['slug'] = Str::slug($validated['name']);
$product->update($validated);

Log::info('✅ Product updated successfully', [
    'id' => $product->id,
    'final_gallery_count' => count($finalGallery),
    'removed_images' => array_map($shortPath, $removedImages),
    'added_images' => array_map($shortPath, $newGalleryUrls),
]);


    return redirect()
        ->route('admin.product.listing')
        ->with('success', '✅ Product updated successfully with updated gallery.');
}



public function destroy($id)
{
    $product = Product::findOrFail($id);

    // Optionally delete image files if you store them locally
    if ($product->main_image && file_exists(public_path('storage/' . $product->main_image))) {
        unlink(public_path('storage/' . $product->main_image));
    }

    if ($product->gallery) {
        $gallery = json_decode($product->gallery, true);
        foreach ($gallery as $image) {
            $path = str_replace(url('/storage') . '/', '', $image);
            if (file_exists(public_path('storage/' . $path))) {
                unlink(public_path('storage/' . $path));
            }
        }
    }

    $product->delete();

    return redirect()->route('admin.product.listing')->with('success', 'Product deleted successfully!');
}

public function create()
{
    $categories = Category::all();
    $brands = Brand::all();
    $taxClasses = TaxClass::all();
    $units = Unit::all();
    $productTypes = ProductType::all();

    return view('admin.products.create', compact('categories', 'brands', 'taxClasses', 'units', 'productTypes'));
}

public function store(Request $request)
{
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
        'sku'               => 'nullable|string|max:100|unique:products,sku',
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
        'is_featured'       => 'nullable|boolean',
        'is_new'            => 'nullable|boolean',
        'is_best_seller'    => 'nullable|boolean',
        'has_3d_model'      => 'nullable|boolean',
    ]);

    // Boolean flags
    foreach (['is_featured', 'is_new', 'is_best_seller', 'has_3d_model'] as $flag) {
        $validated[$flag] = $request->has($flag) ? 1 : 0;
    }

    // Handle main image
    if ($request->hasFile('main_image')) {
        $validated['main_image'] = $request->file('main_image')->store('products/main', 'public');
    }

    // Handle gallery images
    if ($request->hasFile('gallery')) {
        $galleryPaths = [];
        foreach ($request->file('gallery') as $image) {
            $galleryPaths[] = $image->store('products/gallery', 'public');
        }
        $validated['gallery'] = json_encode($galleryPaths);
    }

    // Generate slug
    $validated['slug'] = Str::slug($validated['name']) . '-' . time();

    Product::create($validated);

    return redirect()->route('admin.product.listing')->with('success', 'Product created successfully!');
}
}
