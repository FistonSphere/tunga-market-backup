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
        // ->groupBy('category') // groups by buyer/seller/platform
        // ->map(function ($categoryGroup) {
        //     return $categoryGroup->groupBy('topic'); // then group inside each category by topic
        // });

    return view('frontend.help-center', compact('faqs'));
}


}
