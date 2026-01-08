<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Models\Venue;

class VenueController extends Controller
{
     public function index()
    {
        $venues = Venue::all();
        return view('AvailableVenues.index', compact('venues'));
    }
     public function search(Request $request)
    {
        $query = Venue::query();

    if ($request->filled('q')) {
        $query->where(function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->q . '%')
              ->orWhere('location', 'like', '%' . $request->q . '%');
        });
    }

    // If the user provided a date, filter out venues that are unavailable on that date
    $date = $request->input('date');
    $booksession = $request->input('booksession');

    if ($date) {
        // Exclude venues that have an unavailable date on the requested date
        $query->whereDoesntHave('unavailableDates', function ($q) use ($date) {
            $q->where('date', $date);
        });

        // Exclude venues that have conflicting bookings for that date/session
        if (Schema::hasColumn('bookings', 'booksession')) {
            $query->whereDoesntHave('bookings', function ($q) use ($date, $booksession) {
                // only consider active bookings as conflicts (ignore admin-rejected bookings)
                $q->where('booking_date', $date)
                  ->where(function ($q3) {
                      $q3->whereNull('status')->orWhere('status', '<>', 'rejected');
                  })
                  ->where(function ($q2) use ($booksession) {
                      if ($booksession === 'all_day') {
                          // all_day conflicts with any existing session
                          $q2->whereIn('booksession', ['morning', 'evening', 'all_day']);
                      } elseif ($booksession) {
                          // morning/evening conflict with same session or all_day
                          $q2->where('booksession', $booksession)
                             ->orWhere('booksession', 'all_day');
                      } else {
                          // No session specified: conflict with any booking on that date
                          $q2->whereIn('booksession', ['morning', 'evening', 'all_day']);
                      }
                  });
            });
        } else {
            // If the booksession column doesn't exist, avoid session checks and just exclude
            // venues that have any booking on that date
            $query->whereDoesntHave('bookings', function ($q) use ($date) {
                $q->where('booking_date', $date);
            });
        }
    }

    $venues = $query->get();

    return view('SearchVenues.Sindex', compact('venues'));
    }
}
