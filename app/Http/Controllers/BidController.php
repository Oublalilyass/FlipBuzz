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
            flash()->warning('The listing you are trying to bid on does not exist.');
            return back();
        }
    
        if (Auth::user()->id === $listing->user_id) {
            flash()->warning('You cannot place a bid on your own listing.');
            return back();
        }
    
        // Create and save the bid
        $bid = new Bid();
        $bid->listing_id = $listingId;
        $bid->user_id = Auth::user()->id;
        $bid->amount = $request->amount;
        $bid->save();
    
        // Notify the listing owner
        if ($listing->user) {
            $listing->user->notify(new BidPlaced($bid));
            flash()->success('Bid placed successfully, and notification sent to the listing owner!');
        } else {
            flash()->warning('No user found for the listing.');
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
        $userBid = Bid::where('user_id', Auth::id())
                       ->where('listing_id', $id)
                       ->first();

        return view('listings.show', compact('listing', 'userBid'));
    }
}
