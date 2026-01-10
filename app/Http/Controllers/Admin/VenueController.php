<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Venue;
use App\Models\UnavailableDate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage; // Add this import
use Illuminate\Validation\Rule;

class VenueController extends Controller
{
    public function index()
    {
        $venues = Venue::orderBy('name')->get();
        return view('admin.venues.index', compact('venues'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'nullable|string|max:255',
            'capacity' => 'nullable|integer|min:0',
            'is_available' => ['nullable', Rule::in([0,1])],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data['is_available'] = $request->filled('is_available') ? (bool) $request->is_available : true;

        // Handle optional image upload - ADD THIS HERE
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('venues', 'public');
            $data['image'] = $imagePath;
        }

        $venue = Venue::create($data);

        return Redirect::route('admin.venues.index')->with('success', 'Venue created successfully.');
    }

    public function destroy(Venue $venue)
    {
        // Prevent deletion if there are existing bookings
        if ($venue->bookings()->exists()) {
            return Redirect::route('admin.venues.index')->withErrors('Cannot delete venue with existing bookings.');
        }

        // Delete image if exists - ADD THIS
        if ($venue->image) {
            Storage::disk('public')->delete($venue->image);
        }

        // delete unavailable dates first
        $venue->unavailableDates()->delete();
        $venue->delete();

        return Redirect::route('admin.venues.index')->with('success', 'Venue deleted successfully.');
    }

    public function addUnavailable(Request $request, Venue $venue)
    {
        $data = $request->validate([
            'date' => 'required|date',
        ]);

        // avoid duplicate
        $exists = UnavailableDate::where('venue_id', $venue->id)
            ->where('date', $data['date'])
            ->exists();

        if ($exists) {
            return Redirect::route('admin.venues.index')->withErrors('This date is already marked unavailable for the venue.');
        }

        UnavailableDate::create([
            'venue_id' => $venue->id,
            'date' => $data['date'],
        ]);

        return Redirect::route('admin.venues.index')->with('success', 'Unavailable date added.');
    }

    public function removeUnavailable(Venue $venue, UnavailableDate $unavailable)
    {
        if ($unavailable->venue_id !== $venue->id) {
            abort(404);
        }

        $unavailable->delete();
        return Redirect::route('admin.venues.index')->with('success', 'Unavailable date removed.');
    }
}