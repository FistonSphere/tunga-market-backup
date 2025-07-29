<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    //index method to show the about page
    public function index(){

        return view('frontend.about');
    }
}
