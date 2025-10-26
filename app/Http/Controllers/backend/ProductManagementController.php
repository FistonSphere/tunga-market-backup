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

    // ✅ Checkboxes
    foreach (['is_featured', 'is_new', 'is_best_seller', 'has_3d_model'] as $flag) {
        $validated[$flag] = $request->has($flag) ? 1 : 0;
    }

    // ✅ Specifications + Features
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

        if ($product->main_image) {
            $oldPath = str_replace('/storage/', '', parse_url($product->main_image, PHP_URL_PATH));
            if (Storage::disk('public')->exists($oldPath)) {
                Storage::disk('public')->delete($oldPath);
            }
        }

        $validated['main_image'] = asset('storage/' . $path);
    }

    // ✅ Local helper for short path display
    $shortPath = function ($path) {
        if (!$path) return '';
        $segments = explode('/', parse_url($path, PHP_URL_PATH));
        return implode('/', array_slice($segments, -2));
    };

    // ✅ --- GALLERY HANDLING SECTION ---
$existingGallery = json_decode($product->gallery, true) ?? [];
if (!is_array($existingGallery)) $existingGallery = [];

$submittedGallery = $request->input('gallery');
Log::info('📤 Submitted gallery (raw)', ['short' => substr($submittedGallery ?? '', 0, 200)]);

// Decode submitted gallery JSON (base64 or existing URLs)
$frontendGallery = [];
if ($submittedGallery) {
    $decoded = is_string($submittedGallery) ? json_decode($submittedGallery, true) : $submittedGallery;
    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
        $frontendGallery = $decoded;
    } else {
        Log::warning('⚠️ Invalid gallery JSON', ['error' => json_last_error_msg()]);
    }
}

$frontendGallery = array_filter($frontendGallery, fn($url) => is_string($url) && !empty($url));

// Determine which old images user removed in UI
$removedImages = array_diff($existingGallery, $frontendGallery);
Log::info('❌ To remove', ['count' => count($removedImages)]);

foreach ($removedImages as $oldImage) {
    $oldPath = str_replace('/storage/', '', parse_url($oldImage, PHP_URL_PATH));
    if (Storage::disk('public')->exists($oldPath)) {
        Storage::disk('public')->delete($oldPath);
        Log::info('🗑 Deleted old image', ['short' => $oldPath]);
    }
}

// Prepare final list (start with remaining old gallery)
$finalGallery = array_values(array_diff($existingGallery, $removedImages));

// Handle NEW images from <input type="file">
if ($request->hasFile('gallery')) {
    foreach ($request->file('gallery') as $file) {
        if ($file && $file->isValid()) {
            $filename = 'product_gallery_' . $product->id . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('products/gallery', $filename, 'public');
            $url = asset('storage/' . $path);
            $finalGallery[] = $url;
            Log::info('📸 Uploaded new image', ['short' => $url]);
        }
    }
}

// Handle NEW base64 images from frontend (if any)
foreach ($frontendGallery as $img) {
    if (Str::startsWith($img, 'data:image')) {
        preg_match('/^data:image\/(\w+);base64,/', $img, $type);
        $extension = $type[1] ?? 'png';
        $data = substr($img, strpos($img, ',') + 1);
        $decodedData = base64_decode($data);
        if ($decodedData !== false) {
            $fileName = 'product_gallery_' . $product->id . '_' . uniqid() . '.' . $extension;
            $path = 'products/gallery/' . $fileName;
            Storage::disk('public')->put($path, $decodedData);
            $finalGallery[] = asset('storage/' . $path);
            Log::info('✅ Saved base64 image', ['short' => $path]);
        }
    }
}

// Remove duplicates and invalid URLs
$finalGallery = array_values(array_unique(array_filter($finalGallery, function ($url) {
    return is_string($url) && preg_match('/^https?:\/\/|^\/storage\//', $url);
})));

$validated['gallery'] = json_encode($finalGallery);

Log::info('✅ Final gallery ready', ['count' => count($finalGallery)]);


    // ✅ Generate unique slug
    $validated['slug'] = Str::slug($validated['name'] . '-' . uniqid());

    $product->update($validated);

    

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
