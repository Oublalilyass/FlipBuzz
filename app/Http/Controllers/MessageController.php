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
    public function show($id)
    {
    // Find the message by its ID
    $message = Message::findOrFail($id);

    // Ensure the user is either the sender or the receiver of the message
    if (Auth::id() !== $message->sender_id && Auth::id() !== $message->receiver_id) {
        abort(403, 'Unauthorized access');
    }

    // Return a view to display the message
    return view('messages.show', compact('message'));
    }

    public function sendMessage(Request $request, $listing_id, $message_id = null)
    {
        $request->validate([
            'message_body' => 'required',
        ]);
    
        // Find the listing
        $listing = Listing::find($listing_id);
    
        if ($listing && $listing->user) {
            // If replying, find the original message
            $receiver_id = $listing->user_id;
            $parent_id = null;
    
            if ($message_id) {
                $originalMessage = Message::findOrFail($message_id);
                $receiver_id = $originalMessage->sender_id; // Reply to the original sender
                $parent_id = $originalMessage->id; // Set parent_id to the original message's id
            }
    
            // Create the message or reply
            $message = Message::create([
                'sender_id' => Auth::id(),
                'receiver_id' => $receiver_id,
                'listing_id' => $listing->id,
                'message_body' => $request->message_body,
                'read_status' => 0, // Mark as unread
                'parent_id' => $parent_id, // Set parent ID if it's a reply
            ]);
    
            // Notify the listing owner or the original sender
            if ($message_id) {
                $originalMessage->sender->notify(new NewMessageNotification($message));
            } else {
                $listing->user->notify(new NewMessageNotification($message));
            }
    
            // Add a success flash message
            flash()->success('Message sent successfully!');
        } else {
            flash()->warning('No user found for the listing!');
        }
    
        // Redirect back to the appropriate page
        return redirect()->route('messages.show', $message_id ? $originalMessage->id : $listing_id);
    }
    
    
   
    // Method to view received messages
    public function viewReceivedMessages() {
        // Get the authenticated user ID
        $authUserId = Auth::id();

        // Retrieve all messages where the authenticated user is the receiver
        $messages = Message::where('receiver_id', $authUserId)
                           ->orderBy('created_at', 'desc')
                           ->get();
        
        // Return view with the received messages
        return view('messages.received', compact('messages'));
    }
}