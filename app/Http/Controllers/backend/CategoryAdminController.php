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
        return view('admin.category.edit', compact('category'));
    }

public function update(Request $request, $id)
{
    $category = Category::findOrFail($id);

    // Validate input
    $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255|unique:categories,slug,'.$category->id,
        'description' => 'nullable|string',
        'thumbnail' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        'is_active' => 'nullable|boolean',
    ]);

    // Update basic fields
    $category->name = $request->name;
    $category->slug = $request->slug;
    $category->description = $request->description;
    $category->is_active = $request->has('is_active') ? 1 : 0;

    // Handle thumbnail upload as public URL
    if ($request->hasFile('thumbnail')) {
        $file = $request->file('thumbnail');
        $filename = time().'_'.$file->getClientOriginalName();
        $destinationPath = public_path('uploads/categories');
        $file->move($destinationPath, $filename);

        // Save the public URL
        $category->thumbnail = url('uploads/categories/'.$filename);
    }

    $category->save();

    return redirect()->route('category.admin.index')
                     ->with('success', 'Category updated successfully!');
}


}
