<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\BusinessDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Bid;
use App\Http\Requests\ListingRequest;


class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Get all listings ordered by creation date
        $listings = Listing::where('is_verified', true)->orderBy('created_at', 'desc')->get();

         // Limit the description length for each listing
        $listings->map(function ($listing) {
               $listing->description = Str::limit($listing->description, 80);
               return $listing;
         });

        return view('listings.index', compact('listings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('listings.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ListingRequest $request)
    {
       
        // Validate the incoming request
        $validated = $request->all();
        // Handle image upload
        if ($request->hasFile('images')) {
            // Check if the file was uploaded successfully
            if ($request->file('images')->isValid()) {
                $imagePath = $request->file('images')->store('images', 'public');
                $validated['images'] = $imagePath; // Add image path to validated data
            } 

        // Add the user_id to the validated data
        $validated['user_id'] = Auth::id();  
    
        // Create a new listing with the updated validated data
        Listing::create($validated);
     
        flash()->success('Listing created successfully!');
    
        // Redirect to the listings index route with a success message
        return redirect()->route('listings.index');
    }
}


    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Find the listing by ID and load the related business details
        $listing = Listing::findOrFail($id);
        $businessDetail = BusinessDetail::where('listing_id', $id)->first(); // Assuming one-to-one relationship

        $bids = Bid::where('listing_id', $id)->orderBy('amount', 'desc')->get();

        // Pass the listing and business details to the view
        return view('listings.show', compact('listing', 'businessDetail', 'bids'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        // Retrieve the listing by ID
        $listing = Listing::findOrFail($id);
        $this->authorize('update', $listing);

        // Return the edit view with the listing data
        return view('listings.edit', compact('listing'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ListingRequest $request, Listing $listing)
    {
    // Authorization check
    $this->authorize('update', $listing);

    // Validate the incoming request
    $validated = $request->all();
    // Handle image upload
    if ($request->hasFile('images')) {
        // Check if the file was uploaded successfully
        if ($request->file('images')->isValid()) {
            $imagePath = $request->file('images')->store('images', 'public');
            $validated['images'] = $imagePath; // Add image path to validated data
        } 
    }
    // Handle the new image upload if present
    if ($request->hasFile('images')) {
        // Delete the old image if it exists
        if ($listing->images) {
            Storage::delete('public/' . $listing->images);
        }

        // Store the new image
        $imagePath = $request->file('images')->store('imagese', 'public');
        $validated['images'] = $imagePath; // Store the new image path
    }

    // Update the listing
    $listing->update($validated);

    flash()->success('Listing updated successfully!');

    return redirect()->route('listings.index');
}

    

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Listing $listing
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Listing $listing)
    {
         // Authorization check
         $this->authorize('delete', $listing);
         
        // Delete the listing
        $listing->delete();

        flash()->warning('Listing deleted successfully !');

        // Redirect to the listings index route with a success message
        return redirect()->route('listings.index');
    }
     
    /**
     * Mark a listing as verified.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function verify($id)
    {
        $this->authorize('verify', Listing::class); // Authorize using the 'verify' policy method
    
        // Find the listing and update its verified status
        $listing = Listing::findOrFail($id);
        $listing->is_verified = true;
        $listing->save();
    
        flash()->success('Listing verified successfully!');
    
        return redirect()->route('listings.index');
    }
    

// Add it In listing management page
//     @if(!$listing->is_verified && auth()->user()->isAdmin()) 
//     <form action="{{ route('listings.verify', $listing->id) }}" method="POST">
//         @csrf
//         @method('PATCH')
//         <button type="submit" class="btn btn-primary">Verify</button>
//     </form>
//     @endif

}
