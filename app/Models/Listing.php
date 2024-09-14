<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $fillable = [
        'title', 
        'description',
        'price',
        'type', 
        'user_id',  // Add user_id field to associate with a user
        'images', 
        'site_age', 
        'monthly_profit', 
        'profit_margin', 
        'page_views', 
        'profit_multiple', 
        'revenue_multiple'
    ];
    
    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id'); // Assuming 'user_id' is the owner field
    }

    public function businessDetail()
    {
        return $this->hasOne(BusinessDetail::class, 'listing_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
     // Get the highest bid on the listing.
    public function highestBid()
    {
    return $this->bids()->orderBy('amount', 'desc')->first();
    }
 
}
