<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
        // Logic to retrieve and display about information
        return view('frontend.about'); // Adjust the view name as necessary
    }
}
