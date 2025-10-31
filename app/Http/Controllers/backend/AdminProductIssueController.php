<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\ProductIssue;
use Illuminate\Http\Request;

class AdminProductIssueController extends Controller
{
   public function index(){
   $issues = ProductIssue::with('order','user','product')->get();
   
    return view('admin.product-issues.index',compact('issues'));
   }
}
