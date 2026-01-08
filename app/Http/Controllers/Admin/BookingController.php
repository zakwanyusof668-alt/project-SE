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
        // Show upcoming bookings only (exclude past/completed and already rejected)
        $bookings = Booking::with('user','venue')
            ->whereDate('booking_date', '>=', Carbon::today())
            ->where(function ($q) {
                $q->whereNull('status')->orWhere('status', '!=', 'rejected');
            })
            ->orderBy('booking_date')
            ->get();

        return view('admin.bookings.index', compact('bookings'));
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
