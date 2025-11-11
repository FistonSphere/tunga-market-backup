<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\SuccessStory;
use Illuminate\Http\Request;

class AdminSuccessStoryController extends Controller
{
    public function index()
    {
        $stories = SuccessStory::latest()->get();
        return view('admin.success-story.index', compact('stories'));
    }
}
