<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">Manage Bookings</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Upcoming Bookings</h3>

                @if($bookings->isEmpty())
                    <p>No upcoming bookings.</p>
                @else
                    <div class="space-y-4">
                        @foreach($bookings as $booking)
                            <div class="p-4 border rounded">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <div class="font-semibold">{{ $booking->venue->name ?? '—' }} — {{ $booking->booking_date ?? 'No date' }}</div>
                                        <div class="text-sm text-gray-600">Session: {{ ucfirst($booking->booksession ?? '—') }}</div>
                                        <div class="text-sm text-gray-600">User: {{ $booking->user->name ?? '—' }} ({{ $booking->user->email ?? '—' }})</div>
                                        @if($booking->purpose)
                                            <div class="text-sm text-gray-700 mt-1">Purpose: {{ $booking->purpose }}</div>
                                        @endif
                                    </div>

                                    <div class="text-right">
                                        {{-- Cancel button toggles form --}}
                                        <button type="button" onclick="document.getElementById('cancel-form-{{ $booking->id }}').classList.toggle('hidden')" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Cancel Booking</button>
                                    </div>
                                </div>

                                <div id="cancel-form-{{ $booking->id }}" class="mt-3 hidden">
                                    <form action="{{ route('admin.bookings.reject', $booking) }}" method="POST">
                                        @csrf
                                        <label for="reason-{{ $booking->id }}" class="block text-sm font-medium text-gray-700">Reason for cancellation (required)</label>
                                        <textarea id="reason-{{ $booking->id }}" name="reason" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                                        <div class="mt-2 flex gap-2">
                                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Submit & Reject</button>
                                            <button type="button" onclick="document.getElementById('cancel-form-{{ $booking->id }}').classList.add('hidden')" class="px-4 py-2 bg-gray-300 rounded">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
