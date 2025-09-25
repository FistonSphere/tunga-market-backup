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
       $categories = Faq::all()
        ->groupBy('category')
        ->map(function ($faqs) {
            return $faqs->groupBy('topic');
        });
       return view('frontend.help-center', compact('faqs','categories')); // Adjust the view name as necessary
   }
}
