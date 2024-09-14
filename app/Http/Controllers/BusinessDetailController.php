<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusinessDetail;

class BusinessDetailController extends Controller
{
    public function index()
    {
        // Get all business details
        return BusinessDetail::all();
    }

    public function store(Request $request)
    {
        // Validate and create a new business detail
        $validated = $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'about_the_business' => 'nullable|string',
            'comparisons_benchmarking' => 'nullable|string',
            'revenue_expenses' => 'nullable|array',
            'performance_data' => 'nullable|array',
            'google_analytics_data' => 'nullable|array',
            'monetization_methods' => 'nullable|string',
            'products_services_used' => 'nullable|string',
            'sale_includes' => 'nullable|string',
            'social_media' => 'nullable|string',
            'attachments' => 'nullable|array'
        ]);

        return BusinessDetail::create($validated);
    }
}
