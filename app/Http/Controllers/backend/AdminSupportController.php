<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminSupportController extends Controller
{
   public function index()
   {
    
       return view('admin.support.index');
   }
}
