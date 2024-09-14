<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bid;
use App\Models\Listing;
use App\Notifications\BidPlaced;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    public function store(Request $request, $listingId)
    {
        $this->validate($request, [
            'amount' =>'required|numeric|min:1',
        ]);

        $listing = Listing::find($listingId);

        if (!$listing) {
            flash()->warning('Listing not found!');
        }
         //Why this display
        if (Auth::user()->id === $listing->user_id) {
            flash()->warning('You cannot bid on your own listing!');
        }

        $bid = new Bid();
        $bid->listing_id = $listingId;
        $bid->user_id = Auth::user()->id;
        $bid->amount = $request->amount;
        $bid->save();

       // Notify the listing owner
       $listing = Listing::find($listingId);

       if ($listing && $listing->user) {
           $listing->user->notify(new BidPlaced($bid));
       } else {

        // Redirect to the listings index route with a success message
        flash()->success('You bid successfully!');
       }
        // Redirect to the listings show route with the listingId
        return redirect()->route('listings.show', ['id' => $listingId]);
    }

    public function index($listingId)
    {
        $listing = Listing::findOrFail($listingId);
        $bids = $listing->bids()->orderBy('amount', 'desc')->get();

        return view('bids.index', compact('listing', 'bids'));
    }

    public function show($id)
    {
    $listing = Listing::findOrFail($id);
    $userBid = Bid::where('user_id', Auth::id())->where('listing_id', $id)->first();
    dd($userBid);
    return view('listings.show', compact('listing', 'userBid'));
    }
}
