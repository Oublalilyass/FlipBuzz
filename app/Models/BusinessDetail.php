<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessDetail extends Model
{
    protected $fillable = [
        'listing_id', 'about_the_business', 'comparisons_benchmarking', 
        'revenue_expenses', 'performance_data', 'google_analytics_data',
        'monetization_methods', 'products_services_used', 'sale_includes', 
        'social_media', 'attachments'
    ];
    
    protected $casts = [
        'revenue_expenses' => 'array',
        'performance_data' => 'array',
        'google_analytics_data' => 'array',
        'attachments' => 'array',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}

