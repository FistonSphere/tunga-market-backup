<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryAdminController extends Controller
{
   public function index(){

    $categories = Category::all();
    return view('admin.category.index', compact('categories'));
   }

  public function destroy($id)
{
    $category = Category::findOrFail($id);

    // Optionally delete image files if you store them locally
    if ($category->thumbnail && file_exists(public_path('storage/' . $category->thumbnail))) {
        unlink(public_path('storage/' . $category->thumbnail));
    }
    $category->delete();

    return redirect()->route('category.admin.index')->with('success', 'category deleted successfully!');
}
public function edit($id)
    {
        $category = category::findOrFail($id);
        return view('admin.products.edit', compact('category'));
    }

public function update(Request $request, $id)
{
    Log::info('🔵 category update started', ['category_id' => $id]);
    $category = Category::findOrFail($id);

    $validated = $request->validate([
        'name'              => 'required|string|max:255',
        'thumbnail'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'slug' =>'required|string',
        'description' => 'nullable|string',
        'is_active'            => 'required|numeric',
    ]);

    // ✅ Handle main image
    if ($request->hasFile('main_image')) {
        $file = $request->file('main_image');
        $filename = 'product_main_' . $category->id . '_' . time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('products', $filename, 'public');

        if ($category->main_image) {
            $oldPath = str_replace('/storage/', '', parse_url($category->main_image, PHP_URL_PATH));
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


    // ✅ Generate unique slug
    $validated['slug'] = Str::slug($validated['name'] . '-' . uniqid());

    $category->update($validated);



    return redirect()
        ->route('admin.category.listing')
        ->with('success', '✅ category updated successfully with updated gallery.');
}

}
