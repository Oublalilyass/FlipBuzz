<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
    'sender_id',
    'receiver_id',
    'listing_id',
    'message_body',
    'read_status',
    'parent_id' // New field for replies

    ];

    public function sender() {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver() {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function listing() {
        return $this->belongsTo(Listing::class);
    }
    
     // Relationship for replies (children)
     public function replies()
     {
         return $this->hasMany(Message::class, 'parent_id');
     }
 
     // Relationship for the parent message (if it's a reply)
     public function parent()
     {
         return $this->belongsTo(Message::class, 'parent_id');
     }
}
