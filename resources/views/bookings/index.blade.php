<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">My Bookings</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto space-y-10">

        {{-- Upcoming bookings --}}
        <div>
            <h3 class="text-lg font-bold mb-4">Upcoming Bookings</h3>

            @forelse ($upcomingBookings as $booking)
                <div class="p-4 bg-white shadow rounded mb-3">
                    <p><strong>{{ $booking->venue->name }}</strong></p>
                                        <p>Date: {{ $booking->booking_date }}</p>
                                        <p>Session: {{ ucfirst(str_replace('_', ' ', $booking->booksession)) }}</p>

                                        @if(isset($booking->status) && $booking->status === 'rejected')
                                                <div class="mt-2 p-3 bg-red-50 border border-red-100 rounded">
                                                        <strong class="text-red-700">Rejected by admin</strong>
                                                        @if($booking->admin_reason)
                                                                <div class="text-sm text-gray-700 mt-1">Reason: {{ $booking->admin_reason }}</div>
                                                        @endif
                                                </div>
                                        @else
                                                <form action="{{ route('bookings.cancel', $booking) }}" method="POST"
                                                     onsubmit="return confirm('Are you sure you want to cancel this booking?')">
                                                 @csrf
                                                 @method('DELETE')

                                                 <button type="submit"
                                                     class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">
                                                     Cancel Booking
                                                 </button>
                                         </form>
                                        @endif
                </div>
            @empty
                <p class="text-gray-500">No upcoming bookings.</p>
            @endforelse
        </div>

        {{-- Past bookings --}}
        <div>
            <h3 class="text-lg font-bold mb-4">Past Bookings</h3>

            @forelse ($pastBookings as $booking)
                <div class="p-4 bg-gray-100 rounded mb-3">
                    <p><strong>{{ $booking->venue->name }}</strong></p>
                    <p>Date: {{ $booking->booking_date }}</p>
                </div>
            @empty
                <p class="text-gray-500">No past bookings.</p>
            @endforelse
        </div>

    </div>
</x-app-layout>
