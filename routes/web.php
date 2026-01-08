<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\BookingController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/venues/{venue}/book', [BookingController::class, 'create'])
    ->middleware('auth')
    ->name('venues.book');

Route::post('/venues/{venue}/book', [BookingController::class, 'store'])
    ->middleware('auth')
    ->name('venues.book.store');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/AvailableVenues', [VenueController::class, 'index'])
    ->middleware(['auth'])
    ->name('AvailableVenues.index');


Route::get('/SearchVenues', [VenueController::class, 'search'])
    ->middleware(['auth'])
    ->name('SearchVenues.Sindex');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])
    ->middleware('auth')
    ->name('bookings.cancel');

Route::get('/my-bookings', [BookingController::class, 'index'])
    ->middleware('auth')
    ->name('bookings.index');

Route::post('/venues/{venue}/review', [BookingController::class, 'review'])
    ->middleware('auth')
    ->name('venues.review');

Route::post('/venues/{venue}/confirm', [BookingController::class, 'store'])
    ->middleware('auth')
    ->name('venues.confirm');

// Admin routes
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\VenueController as AdminVenueController;

Route::prefix('admin')->middleware(['auth', \App\Http\Middleware\EnsureUserIsAdmin::class])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/bookings', [AdminBookingController::class, 'index'])->name('admin.bookings.index');
    Route::post('/bookings/{booking}/reject', [AdminBookingController::class, 'reject'])->name('admin.bookings.reject');
    Route::get('/venues', [AdminVenueController::class, 'index'])->name('admin.venues.index');
});




require __DIR__.'/auth.php';
