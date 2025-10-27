<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

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
}
