<?php

namespace App\Providers;

use App\Models\Listing;
use App\Policies\ListingPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         // Manually register the policy
         Gate::policy(Listing::class, ListingPolicy::class);
    }
}
