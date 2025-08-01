<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HelpCenterController extends Controller
{
   public function index()
   {
       // Logic to retrieve and display help center information
       return view('frontend.help'); // Adjust the view name as necessary
   }
}
