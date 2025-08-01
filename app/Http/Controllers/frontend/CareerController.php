<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CareerController extends Controller
{
   public function index()
   {
       // Logic to retrieve and display career opportunities
       return view('frontend.careers'); // Adjust the view name as necessary
   }
}
