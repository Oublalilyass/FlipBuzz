<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use Illuminate\Support\Str; // Import the Str facade

class AdminController extends Controller
{
    public function index()
    {
        // Get all listings (including unverified)
        $listings = Listing::all()->map(function ($listing) {
            // Limit the description to 100 characters
            $listing->title = Str::limit($listing->title, 20, '...');
            $listing->description = Str::limit($listing->description, 50, '...');
            return $listing;
        });

        return view('admin.dashboard', compact('listings'));
    }
}
