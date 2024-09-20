<?php

namespace App\Http\Controllers;

use App\Notifications\NewMessageNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Message;
use App\Models\Listing;

class MessageController extends Controller
{
    public function sendMessage(Request $request, $listing_id) {
        $request->validate([
            'message_body' => 'required',
        ]);

        // Find the listing
         $listing = Listing::find($listing_id);
    
         if ($listing && $listing->user) {
            // Create the message
            $message = Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $listing->user_id,
                'listing_id' => $listing->id,
                'message_body' => $request->message_body,
                'read_status' => 0, // Mark as unread
            ]);

        // Notify the listing owner
        $listing->user->notify(new NewMessageNotification($message));

        // Add a success flash message
        flash()->success('Notification sent to the listing owner!');
        } else {
        // Add a warning flash message if no user is found
        flash()->warning('No user found for the listing!');
        }
        // Redirect back to the listing page
        return redirect()->back();
}
}