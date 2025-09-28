<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
$categories = Category::where('is_active', 1)->with('subcategories')->get();
        return view('frontend.home');
    }
}
