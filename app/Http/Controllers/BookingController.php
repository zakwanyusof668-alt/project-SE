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

    public function store(Request $request, Venue $venue)
    {
        $request->validate([
        'booking_date' => [
            'required',
            'date',
            'after_or_equal:today',
        ],
        'booksession' => 'required|in:morning,evening,all_day',
        'purpose' => 'nullable|string|max:500',
    ]);

    // Check if date is unavailable
    $isUnavailable = UnavailableDate::where('venue_id', $venue->id)
        ->where('date', $request->booking_date)
        ->exists();

    if ($isUnavailable) {
        return back()
            ->withInput()
            ->withErrors([
                'booking_date' => 'This venue is not available on the selected date.',
            ]);
    }

    // Comprehensive session conflict check
    $existingBooking = Booking::where('venue_id', $venue->id)
        ->where('booking_date', $request->booking_date)
        // ignore bookings that were rejected by admin so cancelled slots become available
        ->where(function ($q) {
            $q->whereNull('status')->orWhere('status', '<>', 'rejected');
        })
        ->where(function ($query) use ($request) {
            // If booking all_day, conflict with any session
            if ($request->booksession === 'all_day') {
                $query->whereIn('booksession', ['morning', 'evening', 'all_day']);
            } 
            // If booking morning/evening, conflict with same session or all_day
            else {
                $query->where('booksession', $request->booksession)
                      ->orWhere('booksession', 'all_day');
            }
        })
        ->exists();

    if ($existingBooking) {
        return back()
            ->withInput()
            ->withErrors([
                'booksession' => 'This venue is already booked for the selected date and session.',
            ]);
    }

    Booking::create([
        'user_id' => auth()->id(),
        'venue_id' => $venue->id,
        'booking_date' => $request->booking_date,
        'booksession' => $request->booksession, // ✅ Fixed column name
        'purpose' => $request->purpose,
    ]);

    return redirect()
        ->route('SearchVenues.Sindex')
        ->with('success', 'Venue booked successfully!');
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
            ->with('success', 'Booking canceled successfully.');
    }

    public function review(Request $request, Venue $venue)
{

   logger('Step 1: Entered review method');
   logger('Today is: ' . now()->toDateString());
    logger('Booking date is: ' . $request->booking_date);
    logger('Request data:', $request->all());
    
     $request->validate([
        'booking_date' => 'required|date|after_or_equal:today',
        'booksession' => 'required|in:morning,evening,all_day',
        'purpose' => 'nullable|string|max:500',
        'name' => 'required|string|max:255',
        'matric_no' => 'required|string|max:100',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:50',
    ]);
    logger('Step 2: Validation passed');

    // Check unavailable dates
    $isUnavailable = UnavailableDate::where('venue_id', $venue->id)
        ->where('date', $request->booking_date)
        ->exists();
logger('Step 3: Checked unavailable dates', ['isUnavailable' => $isUnavailable]);

    if ($isUnavailable) {
        return back()
            ->withInput()
            ->withErrors([
                'booking_date' => 'This venue is not available on the selected date.',
            ]);
    }

    // Check existing bookings with session
    $existingBooking = Booking::where('venue_id', $venue->id)
        ->where('booking_date', $request->booking_date)
        // ignore admin-rejected bookings when checking conflicts
        ->where(function ($q) {
            $q->whereNull('status')->orWhere('status', '<>', 'rejected');
        })
        ->where(function ($query) use ($request) {
            if ($request->booksession === 'all_day') {
                $query->whereIn('booksession', ['morning', 'evening', 'all_day']);
            } else {
                $query->where('booksession', $request->booksession)
                      ->orWhere('booksession', 'all_day');
            }
        })
        ->exists();
logger('Step 5: Checked existing bookings', ['existingBooking' => $existingBooking]);
    if ($existingBooking) {
         logger('Step 6: Booking exists - returning back');
        return back()
            ->withInput()
            ->withErrors([
                'booksession' => 'This venue is already booked for the selected date and session.',
            ]);
    }
 logger('Step 7: All checks passed - showing review view');
    return view('bookings.review', [
        'venue' => $venue,
        'booking_date' => $request->booking_date,
        'booksession' => $request->booksession,
        'purpose' => $request->purpose,
        'name' => $request->name,
        'matric_no' => $request->matric_no,
        'email' => $request->email,
        'phone' => $request->phone,
        'price' => 'Free',
        'user' => auth()->user(),
    ]);

}
}