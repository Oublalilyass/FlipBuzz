<?php

namespace App\Http\Controllers;

use App\Http\Requests\BusinessRequest;
use Illuminate\Http\Request;
use App\Models\BusinessDetail;

class BusinessDetailController extends Controller
{
    public function index()
    {
        // Get all business details
        return BusinessDetail::all();
    }

    public function store(BusinessRequest $request)
    {
        // Validate and create a new business detail
        $validated = $request->all();

        return BusinessDetail::create($validated);
    }
}
