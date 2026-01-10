<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venue;
use App\Models\Booking;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function index()
    {
        // Total Venues
        $totalVenues = Venue::count();
        
        // Active Bookings (upcoming bookings that are not rejected or cancelled)
        $activeBookings = Booking::whereDate('booking_date', '>=', Carbon::today())
            ->where(function ($q) {
                $q->whereNull('status')
                  ->orWhereNotIn('status', ['rejected', 'cancelled']);
            })
            ->count();
        
        // Total Bookings (all time)
        $totalBookings = Booking::count();
        
        return view('admin.dashboard', compact(
            'totalVenues',
            'activeBookings',
            'totalBookings'
        ));
    }
}
