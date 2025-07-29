<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactController extends Controller
{
   public function index()
   {
       // Logic to retrieve and display contact information
       return view('frontend.contact'); // Adjust the view name as necessary
   }
}
