<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductManagementController extends Controller
{
   public function index(){
   $products= Product::with('category','brand')->paginate('12');
 
    return view('admin.products.product-list', compact('products'));
   }
}
