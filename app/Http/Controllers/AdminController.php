<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;

class AdminController extends Controller
{
    public function index()
    {
  
        // Get all listings (including unverified)
        $listings = Listing::all();

        return view('admin.dashboard', compact('listings'));
    }
}
