<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
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
        // Validate the incoming request
        $request->validate([
            'message_body' => 'required',
        ]);
    
        try {
            // Find the listing or throw a 404 error if not found
            $listing = Listing::findOrFail($listing_id);
    
            // Initialize variables
            $receiver_id = $listing->user_id; // Default to the listing owner
            $parent_id = null; // Default to no parent message
    
            // If a reply is being sent (message_id is provided)
            if ($message_id) {
                // Find the original message or throw 404 if not found
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
    
            // Notify the appropriate user
            if ($message_id) {
                // Notify the original sender that they've received a reply
                $originalMessage->sender->notify(new NewMessageNotification($message));
            } else {
                // Notify the listing owner that they've received a new message
                $listing->user->notify(new NewMessageNotification($message));
            }
    
            // Flash success message
            flash()->success('Message sent successfully!');
    
            // Redirect to the listing page
            return redirect()->route('listings.index');
        } catch (ModelNotFoundException $e) {
            // Handle the 404 exception for missing listing or message
            flash()->error('Listing or message not found!');
            return redirect()->back();
        }
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