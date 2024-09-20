<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class NotificationController extends Controller
{
    public function markAsRead()
    {
        // Mark all unread notifications as read
        Auth::user()->unreadNotifications->markAsRead();
        
        // Redirect back with a success message or just back to the previous page
        return redirect()->back()->with('status', 'All notifications marked as read.');
    }
    // Test route to show all notifications
    public function showNotifications()
    {
        $user = Auth::user();
        $notifications = $user->notifications;

        foreach ($notifications as $notification) {
            dd($notification->data); // This will show the stored data
        }

        // Alternatively, return the notifications view if you have one
        return view('notifications.index', compact('notifications'));
    }
}
