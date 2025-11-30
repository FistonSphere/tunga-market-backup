<?php

namespace App\Http\Controllers\backend;

use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Enquiry;
use App\Models\ProductType;
use App\Models\TaxClass;
use App\Models\Unit;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;


class ProductManagementController extends Controller
{
   public function index(){
   $products= Product::with('category','brand','units')->paginate('15');
   $categories= Category::where('is_active',1)->get();
    return view('admin.products.product-list', compact('products','categories'));
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

   // -------------------------------------------------
// MAIN IMAGE (same saving style as gallery section)
// -------------------------------------------------
if ($request->hasFile('main_image')) {

    $file = $request->file('main_image');

    // Create folder if not exists
    $mainFolder = public_path('uploads/products/main');
    if (!file_exists($mainFolder)) {
        mkdir($mainFolder, 0755, true);
    }

    $filename = 'product_main_' . $product->id . '_' . time() . '.' . $file->getClientOriginalExtension();

    // Move file manually to public/uploads/products/main
    $file->move($mainFolder, $filename);

    // Delete old main_image file if exists
    if ($product->main_image) {
        $relative = str_replace(url('/'), '', $product->main_image);
        $relative = ltrim($relative, '/'); // fix leading slash

        $fullOldPath = public_path($relative);

        if (file_exists($fullOldPath)) {
            unlink($fullOldPath);
        }
    }

    // Save new image URL
    $validated['main_image'] = url('uploads/products/main/' . $filename);
}


   // --------------------------------------------
//  GALLERY HANDLING (same pattern as main_image)
// --------------------------------------------

$existingGallery = json_decode($product->gallery, true) ?? [];
if (!is_array($existingGallery)) $existingGallery = [];

$submittedGallery = $request->input('gallery');
$frontendGallery = [];

// Decode JSON from frontend
if ($submittedGallery) {
    $decoded = is_string($submittedGallery) ? json_decode($submittedGallery, true) : $submittedGallery;
    if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
        $frontendGallery = array_filter($decoded);
    }
}

// Detect removed images
$removedImages = array_diff($existingGallery, $frontendGallery);

foreach ($removedImages as $oldUrl) {
    $relative = str_replace(url('/'), '', $oldUrl); // remove domain
    $relative = ltrim($relative, '/'); // fix "/uploads/..."

    $fullPath = public_path($relative);

    if (file_exists($fullPath)) {
        unlink($fullPath);
    }
}

// Start with remaining gallery
$finalGallery = array_values(array_diff($existingGallery, $removedImages));

// Prepare upload folder like main_image
$galleryPath = public_path('uploads/products/gallery');
if (!file_exists($galleryPath)) {
    mkdir($galleryPath, 0755, true);
}


// ----------------------------
// 1️⃣ Handle <input type="file">
// ----------------------------
if ($request->hasFile('gallery')) {
    foreach ($request->file('gallery') as $file) {
        if ($file->isValid()) {
            $filename = 'product_gallery_' . $product->id . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($galleryPath, $filename);

            $url = url('uploads/products/gallery/' . $filename);
            $finalGallery[] = $url;
        }
    }
}


// ----------------------------
// 2️⃣ Handle base64 images
// ----------------------------
foreach ($frontendGallery as $item) {
    if (Str::startsWith($item, 'data:image')) {

        preg_match('/^data:image\/(\w+);base64,/', $item, $match);
        $ext = $match[1] ?? 'png';

        $raw = substr($item, strpos($item, ',') + 1);
        $decoded = base64_decode($raw);

        if ($decoded) {
            $filename = 'product_gallery_' . $product->id . '_' . uniqid() . '.' . $ext;
            file_put_contents($galleryPath . '/' . $filename, $decoded);

            $url = url('uploads/products/gallery/' . $filename);
            $finalGallery[] = $url;
        }
    }
}


// --------------------------------------------
// Final cleaning (URLs only)
// --------------------------------------------
$finalGallery = array_values(array_unique(array_filter($finalGallery, function ($u) {
    return is_string($u) && Str::startsWith($u, ['http://', 'https://']);
})));

// Save
$product->gallery = json_encode($finalGallery);
$product->save();

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
    Log::info('🟢 Product creation started');

    $validated = $request->validate([
        'name'               => 'required|string|max:255',
        'slug'               => 'nullable|string|max:255',
        'sku'                => 'nullable|string|max:100',
        'category_id'        => 'nullable|integer',
        'brand_id'           => 'nullable|integer',
        'unit_id'            => 'nullable|integer',
        'tax_class_id'       => 'nullable|integer',
        'short_description'  => 'nullable|string',
        'long_description'   => 'nullable|string',
        'price'              => 'required|numeric',
        'currency'           => 'nullable|string|max:10',
        'min_order_quantity' => 'nullable|integer|min:1',
        'stock_quantity'     => 'nullable|integer|min:0',
        'main_image'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'gallery'            => 'nullable',
        'gallery.*'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'video_url'          => 'nullable|string|max:255',
        'status'             => 'required|string|in:active,inactive,draft',
        'specifications'     => 'nullable|string',
        'features'           => 'nullable|string',
        'shipping_info'      => 'nullable|string',
        'tags'               => 'nullable|string',

    ]);

    // ensure checkboxes default to 0/1 (they may not exist in request)
    foreach (['is_featured', 'is_new', 'is_best_seller', 'has_3d_model'] as $flag) {
        $validated[$flag] = $request->has($flag) ? 1 : 0;
    }

    // Use slug & sku provided by frontend if present
    if (!empty($validated['slug'])) {
        $validated['slug'] = Str::slug($validated['slug']);
    } else {
        $validated['slug'] = Str::slug($validated['name'] . '-' . uniqid());
    }

    if (!empty($validated['sku'])) {
        $validated['sku'] = strtoupper($validated['sku']);
    } else {
        $validated['sku'] = strtoupper(Str::slug(substr($validated['name'], 0, 6))) . '-' . rand(1000, 9999);
    }

    // Specifications: parse key:value pairs if provided as text (Choice.js might submit comma-separated key:value)
    $specifications = [];
    if ($request->filled('specifications')) {
        // client may send json or "Key:Value,Key2:Value2"
        $raw = $request->input('specifications');
        $decoded = json_decode($raw, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            $specifications = $decoded;
        } else {
            // parse CSV key:value pairs
            $pairs = array_filter(array_map('trim', explode(',', $raw)));
            foreach ($pairs as $pair) {
                if (strpos($pair, ':') !== false) {
                    [$k, $v] = explode(':', $pair, 2);
                    $specifications[trim($k)] = trim($v);
                }
            }
        }
    }
    $validated['specifications'] = empty($specifications) ? null : json_encode($specifications, JSON_UNESCAPED_SLASHES);

    // Features: Choice.js will submit as comma list or JSON array
    $features = [];
    if ($request->filled('features')) {
        $raw = $request->input('features');
        $decoded = json_decode($raw, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            $features = array_map('trim', $decoded);
        } else {
            $features = array_map('trim', array_filter(explode(',', $raw)));
        }
    }
    $validated['features'] = empty($features) ? null : json_encode(array_values($features));

    // Shipping info & tags similar handling (allow JSON or CSV)
    $shipping = $request->filled('shipping_info') ? $request->input('shipping_info') : null;
    $validated['shipping_info'] = $shipping ? (json_last_error() === JSON_ERROR_NONE ? $shipping : $shipping) : null;

    $tagsArr = [];
    if ($request->filled('tags')) {
        $raw = $request->input('tags');
        $decoded = json_decode($raw, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            $tagsArr = $decoded;
        } else {
            $tagsArr = array_map('trim', array_filter(explode(',', $raw)));
        }
    }
    $validated['tags'] = empty($tagsArr) ? null : json_encode(array_values($tagsArr));

    // Create product record *first* so we have an ID for filenames
    $product = Product::create(array_merge(
        // only allowed fillable keys - ensure they exist in $validated
        Arr::only($validated, [
            'name','slug','sku','category_id','brand_id','unit_id','tax_class_id',
            'short_description','long_description','price','currency',
            'min_order_quantity','stock_quantity','video_url','status','specifications',
            'features','shipping_info','tags','is_featured','is_new','is_best_seller','has_3d_model'
        ])
    ));

    Log::info('🆕 Product base created', ['id' => $product->id]);

    // Helper to make short for logging
    $shortPath = function ($path) {
        if (!$path) return '';
        $segments = explode('/', parse_url($path, PHP_URL_PATH));
        return implode('/', array_slice($segments, -3));
    };

    // --- Handle main_image file upload ---
    if ($request->hasFile('main_image')) {
        $file = $request->file('main_image');
        if ($file->isValid()) {
            $filename = 'product_main_' . $product->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/products');
            if (!file_exists($destinationPath)) mkdir($destinationPath, 0755, true);
            $file->move($destinationPath, $filename);
            $product->main_image = url('uploads/products/'.$filename);
            $product->save();
            Log::info('📸 main_image uploaded', ['short' => $shortPath($destinationPath)]);
        }
    }

    // --- Gallery handling: the frontend 'gallery' hidden input contains a JSON array of
    //     existing URLs and possibly base64 data URLs generated from previews.
    $finalGallery = [];

$uploadDir = public_path('uploads/products');
if (!file_exists($uploadDir)) mkdir($uploadDir, 0755, true);

/**
 * 1) Handle JSON/base64 gallery input
 */
$submittedGallery = $request->input('gallery');

if ($submittedGallery) {
    $decoded = is_string($submittedGallery) ? json_decode($submittedGallery, true) : $submittedGallery;

    if (is_array($decoded)) {

        foreach ($decoded as $item) {

            // Keep existing URLs (stored before)
            if (Str::startsWith($item, ['http://', 'https://'])) {
                $finalGallery[] = $item;
                continue;
            }

            // Base64 images
            if (Str::startsWith($item, 'data:image')) {
                preg_match('/^data:image\/(\w+);base64,/', $item, $type);
                $ext = $type[1] ?? 'png';

                $data = substr($item, strpos($item, ',') + 1);
                $decodedData = base64_decode($data);

                if ($decodedData !== false) {

                    $filename = 'product_gallery_' . $product->id . '_' . uniqid() . '.' . $ext;
                    $filePath = $uploadDir . '/' . $filename;

                    file_put_contents($filePath, $decodedData);

                    $finalGallery[] = url('uploads/products/' . $filename);

                    Log::info('🖼️ gallery saved from base64', ['file' => $filename]);
                }
            }
        }

    } else {
        Log::warning('⚠ gallery input invalid (not JSON array)');
    }
}

/**
 * 2) Handle normal uploaded gallery[] files
 */
if ($request->hasFile('gallery')) {

    foreach ($request->file('gallery') as $file) {

        if ($file && $file->isValid()) {
            $filename = 'product_gallery_' . $product->id . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

            $file->move($uploadDir, $filename);

            $finalGallery[] = url('uploads/products/' . $filename);

            Log::info('📁 gallery file uploaded', ['file' => $filename]);
        }
    }
}

/**
 * 3) Clean, remove duplicates and save JSON list
 */
$finalGallery = array_values(array_unique(array_filter($finalGallery)));

$product->gallery = !empty($finalGallery) ? json_encode($finalGallery) : null;
$product->save();


    Log::info('✅ Product fully created', [
        'id' => $product->id,
        'gallery_count' => count($finalGallery),
        'gallery_short' => array_map($shortPath, $finalGallery)
    ]);

    return redirect()
        ->route('admin.product.listing')
        ->with('success', '✅ Product created successfully.');
}

public function filter(Request $request)
{
    $query = Product::with(['category', 'brand']);

    if ($request->filled('search')) {
        $search = $request->input('search');
        $query->where('name', 'like', "%{$search}%")
              ->orWhere('sku', 'like', "%{$search}%");
    }

    if ($request->filled('category')) {
        $query->where('category_id', $request->input('category'));
    }

    if ($request->filled('min_price')) {
        $query->where('price', '>=', $request->input('min_price'));
    }

    if ($request->filled('max_price')) {
        $query->where('price', '<=', $request->input('max_price'));
    }

    $products = $query->orderBy('id', 'desc')->get();

    return response()->json($products);
}

public function printPDF()
{
    $products = Product::with(['category', 'brand'])->get();

    $pdf = Pdf::loadView('admin.products.print', [
        'products' => $products,
        'title' => 'Tunga Market Product Listing',
        'date' => now()->format('F d, Y'),
    ]);

    // Set paper and orientation
    $pdf->setPaper('A4', 'landscape');

    return $pdf->stream('Tunga-Market-Product-Listing.pdf');
}
public function savePDF()
{
    $products = Product::with(['category', 'brand'])->get();

    $pdf = Pdf::loadView('admin.products.print', [
        'products' => $products,
        'title' => 'Tunga Market Product Listing',
        'date' => now()->format('F d, Y'),
    ]);

    // Set paper and orientation
    $pdf->setPaper('A4', 'landscape');

    return $pdf->download('Tunga-Market-Product-Listing.pdf');
}

public function saveExcel()
{
    $fileName = 'Tunga_Market_Product_Listing_' . date('Y_m_d_H_i') . '.xlsx';
    return Excel::download(new ProductsExport(), $fileName);
}




}
