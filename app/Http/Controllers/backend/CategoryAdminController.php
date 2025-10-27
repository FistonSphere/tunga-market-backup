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
    $product = Category::findOrFail($id);

    // Optionally delete image files if you store them locally
    if ($product->main_image && file_exists(public_path('storage/' . $product->main_image))) {
        unlink(public_path('storage/' . $product->main_image));
    }

    

    $product->delete();

    return redirect()->route('admin.product.listing')->with('success', 'Product deleted successfully!');
}
}
