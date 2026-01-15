<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        // Upcoming bookings: future dates AND not rejected/cancelled
        $upcomingBookings = Booking::with('user','venue')
            ->whereDate('booking_date', '>=', Carbon::today())
            ->whereNotIn('status', ['rejected', 'cancelled'])
            ->orderBy('booking_date')
            ->get();

        // Past bookings: past dates OR rejected/cancelled
        $pastBookings = Booking::with('user','venue')
            ->where(function($query) {
                $query->whereDate('booking_date', '<', Carbon::today())
                      ->orWhereIn('status', ['rejected', 'cancelled']);
            })
            ->orderByDesc('booking_date')
            ->get();

        return view('admin.bookings.index', compact('upcomingBookings', 'pastBookings'));
    }

    public function reject(Request $request, Booking $booking)
    {
        $request->validate([
            'reason' => 'required|string|max:1000',
        ]);

        // mark booking as rejected and store admin reason and admin id
        $booking->status = 'rejected';
        $booking->admin_reason = $request->reason;
        $booking->cancelled_by = Auth::id();
        $booking->save();

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking rejected and user notified.');
    }
}