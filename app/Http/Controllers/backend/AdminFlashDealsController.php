<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\FlashDeal;
use Illuminate\Http\Request;

class AdminFlashDealsController extends Controller
{
   public function index(){

    $flashDeals= FlashDeal::all();
    return view('admin.flash-deals.index', compact('flashDeals'));
    
   }
}
