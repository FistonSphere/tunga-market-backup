<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;

class HelpCenterController extends Controller
{
   public function index()
   {
       $faqs = Faq::where('is_active', true)
            ->orderBy('category')
            ->orderBy('topic')
            ->orderBy('created_at', 'desc')
            ->get();

        // Group into categories → topics → faqs
        // $categories = $faqs
        //     ->groupBy('category')
        //     ->map(function ($faqsByCategory) {
        //         return $faqsByCategory->groupBy('topic');
        //     });
// dd($faqs);
        return view('frontend.help-center', compact('faqs'));
   }
}
