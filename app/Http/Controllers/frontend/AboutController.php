<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
        // Logic to retrieve and display about information
        $teamMembers = TeamMember::all();
        return view('frontend.about'); // Adjust the view name as necessary
    }
}
