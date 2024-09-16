<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\BusinessDetailController;
use App\Http\Controllers\BidController;
use App\Http\Controllers\NotificationController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Update this route to point to the listings index
    Route::get('/dashboard', [ListingController::class, 'index'])->name('dashboard');
});

Route::get('/landing', function () {
    return view('landing.index');  
});

// listings
Route::get('/listings', [ListingController::class,'index'])->name('listings.index');
Route::get('/listings/create', [ListingController::class, 'create'])->name('listings.create');
Route::post('/listings', [ListingController::class, 'store'])->name('listings.store');
Route::get('/listings/{id}', [ListingController::class, 'show'])->name('listings.show');
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->name('listings.edit');
Route::put('/listings/{listing}', [ListingController::class, 'update'])->name('listings.update');

//Bid
Route::post('/listings/{listing}/bid', [BidController::class, 'store'])->middleware('auth');

//destroy
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->name('listings.destroy');

// BusinessDetail
Route::get('/business-details', [BusinessDetailController::class, 'index']);
Route::post('/business-details', [BusinessDetailController::class, 'store']);

Route::post('/listings/{listing}/bids', [BidController::class, 'store'])->name('bids.store');
Route::get('/listings/{listing}/bids', [BidController::class, 'index'])->name('bids.index');

Route::get('/mark-as-read', [NotificationController::class, 'markAsRead'])->name('mark-as-read');

Route::get('/notifications', [NotificationController::class, 'index'])->middleware('auth');
