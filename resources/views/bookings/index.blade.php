@section('title', 'My Bookings - KictVeBook')

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">My Bookings</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            {{-- Upcoming bookings --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-xl">
                <div class="bg-gradient-to-r from-indigo-600 to-blue-600 px-6 py-5">
                    <h3 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Upcoming Bookings
                    </h3>
                </div>

                <div class="p-6">
                    @forelse ($upcomingBookings as $booking)
                        <div class="mb-4 last:mb-0 border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-200">
                            <div class="bg-gradient-to-r from-indigo-50 to-blue-50 dark:from-indigo-900/20 dark:to-blue-900/20 px-5 py-4">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-3">
                                            {{ $booking->venue->name }}
                                        </h4>
                                        
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                                                <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <span>{{ $booking->booking_date }}</span>
                                            </div>
                                            
                                            <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                                                <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                                    {{ ucfirst(str_replace('_', ' ', $booking->booksession)) }}
                                                </span>
                                            </div>
                                        </div>

                                        @if(isset($booking->status) && $booking->status === 'rejected')
                                            <div class="mt-4 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                                                <div class="flex items-start gap-2">
                                                    <svg class="w-5 h-5 text-red-600 dark:text-red-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                                                    </svg>
                                                    <div class="flex-1">
                                                        <p class="font-semibold text-red-700 dark:text-red-300">Cancelled by Admin</p>
                                                        @if($booking->admin_reason)
                                                            <p class="text-sm text-red-600 dark:text-red-400 mt-1">
                                                                <strong>Reason:</strong> {{ $booking->admin_reason }}
                                                            </p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>

                                    @if(!isset($booking->status) || $booking->status !== 'rejected')
                                        <div class="ml-4">
                                            <form action="{{ route('bookings.cancel', $booking) }}" method="POST"
                                                 onsubmit="return confirm('Are you sure you want to cancel this booking?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                    Cancel Booking
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="mt-4 text-gray-500 dark:text-gray-400">No upcoming bookings.</p>
                        </div>
                    @endforelse
                </div>
            </div>

          {{-- Past bookings --}}
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-lg sm:rounded-xl">
    <div class="bg-gradient-to-r from-gray-600 to-gray-700 px-6 py-5">
        <h3 class="text-xl font-bold text-white flex items-center gap-2">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            Past Bookings
        </h3>
    </div>

    <div class="p-6">
        @forelse ($pastBookings as $booking)
            <div class="mb-4 last:mb-0 border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                <div class="bg-gray-100 dark:bg-gray-900/50 px-5 py-4">
                    <div class="flex items-center gap-3 mb-3">
                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            {{ $booking->venue->name }}
                        </h4>
                        @if($booking->status === 'rejected')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                Cancelled by Admin
                            </span>
                        @elseif($booking->status === 'cancelled')
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-200">
                                Cancelled by You
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                Completed
                            </span>
                        @endif
                    </div>
                    
                    <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 mb-2">
                        <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>{{ $booking->booking_date }}</span>
                        <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-200 text-gray-700 dark:bg-gray-700 dark:text-gray-300">
                            {{ ucfirst(str_replace('_', ' ', $booking->booksession)) }}
                        </span>
                    </div>

                    {{-- Show admin rejection reason --}}
                    @if($booking->status === 'rejected' && $booking->admin_reason)
                        <div class="mt-3 p-3 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg">
                            <div class="flex items-start gap-2">
                                <svg class="w-4 h-4 text-red-600 dark:text-red-400 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    <p class="text-sm font-medium text-red-700 dark:text-red-300">Admin's Reason:</p>
                                    <p class="text-sm text-red-600 dark:text-red-400 mt-1">{{ $booking->admin_reason }}</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="mt-4 text-gray-500 dark:text-gray-400">No past bookings.</p>
            </div>
        @endforelse
    </div>
</div>

        </div>
    </div>
</x-app-layout>