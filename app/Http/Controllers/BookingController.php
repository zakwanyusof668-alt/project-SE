<?php

namespace App\Http\Controllers;

use App\Models\Venue;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use App\Models\UnavailableDate;

class BookingController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $upcomingBookings = Booking::with('venue')
            ->where('user_id', $userId)
            ->whereDate('booking_date', '>=', Carbon::today())
            ->orderBy('booking_date')
            ->get();

        $pastBookings = Booking::with('venue')
            ->where('user_id', $userId)
            ->whereDate('booking_date', '<', Carbon::today())
            ->orderByDesc('booking_date')
            ->get();

        return view('bookings.index', compact('upcomingBookings', 'pastBookings'));
    }

    public function create(Venue $venue)
    {
        $unavailableDates = $venue->unavailableDates
            ->pluck('date')
            ->toArray();

        return view('bookings.create', compact('venue', 'unavailableDates'));
    }

    public function review(Request $request, Venue $venue)
    {
        // Validate all input fields
        $validated = $request->validate([
            'booking_date' => 'required|date|after_or_equal:today',
            'booksession' => 'required|in:morning,evening,all_day',
            'purpose' => 'required|string|max:500',
            'name' => 'required|string|max:255',
            'matric_no' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
        ]);

        // Check if date is unavailable
        $isUnavailable = UnavailableDate::where('venue_id', $venue->id)
            ->where('date', $validated['booking_date'])
            ->exists();

        if ($isUnavailable) {
            return back()
                ->withInput()
                ->withErrors([
                    'booking_date' => 'This venue is not available on the selected date.',
                ]);
        }

        // Check for duplicate bookings with session conflict logic
        $existingBooking = Booking::where('venue_id', $venue->id)
            ->where('booking_date', $validated['booking_date'])
            ->whereNotIn('status', ['rejected', 'cancelled']) // Ignore rejected/cancelled
            ->where(function ($query) use ($validated) {
                // If trying to book all_day, conflict with any session
                if ($validated['booksession'] === 'all_day') {
                    $query->whereIn('booksession', ['morning', 'evening', 'all_day']);
                } 
                // If trying to book morning/evening, conflict with same session or all_day
                else {
                    $query->where(function ($q) use ($validated) {
                        $q->where('booksession', $validated['booksession'])
                          ->orWhere('booksession', 'all_day');
                    });
                }
            })
            ->exists();

        if ($existingBooking) {
            return back()
                ->withInput()
                ->withErrors([
                    'booking_date' => 'This venue is already booked for the selected date and session. Please choose a different date or session.',
                ]);
        }

        // Calculate price based on session
        $price = match($validated['booksession']) {
            'morning' => 'RM 50.00',
            'evening' => 'RM 50.00',
            'all_day' => 'RM 80.00',
            default => 'Free',
        };

        // Show review/confirmation page
        return view('bookings.review', [
            'venue' => $venue,
            'booking_date' => $validated['booking_date'],
            'booksession' => $validated['booksession'],
            'purpose' => $validated['purpose'],
            'name' => $validated['name'],
            'matric_no' => $validated['matric_no'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'price' => $price,
            'user' => auth()->user(),
        ]);
    }

    public function store(Request $request, Venue $venue)
    {
        // Validate all fields
        $validated = $request->validate([
            'booking_date' => 'required|date|after_or_equal:today',
            'booksession' => 'required|in:morning,evening,all_day',
            'purpose' => 'required|string|max:500',
            'name' => 'required|string|max:255',
            'matric_no' => 'required|string|max:100',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:50',
        ]);

        // Check if date is unavailable
        $isUnavailable = UnavailableDate::where('venue_id', $venue->id)
            ->where('date', $validated['booking_date'])
            ->exists();

        if ($isUnavailable) {
            return back()
                ->withInput()
                ->withErrors([
                    'booking_date' => 'This venue is not available on the selected date.',
                ]);
        }

        // FINAL CHECK: Prevent duplicate bookings with session conflict logic
        $existingBooking = Booking::where('venue_id', $venue->id)
            ->where('booking_date', $validated['booking_date'])
            ->whereNotIn('status', ['rejected', 'cancelled']) // Ignore rejected/cancelled
            ->where(function ($query) use ($validated) {
                // If trying to book all_day, conflict with any session
                if ($validated['booksession'] === 'all_day') {
                    $query->whereIn('booksession', ['morning', 'evening', 'all_day']);
                } 
                // If trying to book morning/evening, conflict with same session or all_day
                else {
                    $query->where(function ($q) use ($validated) {
                        $q->where('booksession', $validated['booksession'])
                          ->orWhere('booksession', 'all_day');
                    });
                }
            })
            ->exists();

        if ($existingBooking) {
            return redirect()->route('dashboard')
                ->withErrors([
                    'booking' => 'Sorry, this venue was just booked by someone else. Please try a different date or session.',
                ]);
        }

        // Create the booking
        Booking::create([
            'user_id' => auth()->id(),
            'venue_id' => $venue->id,
            'booking_date' => $validated['booking_date'],
            'booksession' => $validated['booksession'],
            'purpose' => $validated['purpose'],
            'name' => $validated['name'],
            'matric_no' => $validated['matric_no'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'status' => null, // or 'pending' if you use that
        ]);

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Venue booked successfully! Your booking is confirmed.');
    }

    public function destroy(Booking $booking)
    {
        // Ensure the authenticated user owns the booking
        if ($booking->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $booking->delete();

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Booking cancelled successfully.');
    }
}