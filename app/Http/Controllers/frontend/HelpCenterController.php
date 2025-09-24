<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class HelpCenterController extends Controller
{
   public function index()
   {
       // Logic to retrieve and display help center information
       $faqs = Faq::where('is_active', true)->orderBy('created_at', 'desc')->get();
       return view('frontend.help-center', compact('faqs')); // Adjust the view name as necessary
   }
}
