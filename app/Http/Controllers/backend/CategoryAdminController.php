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
}
