<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">Manage Bookings</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                    @if($bookings->isEmpty())
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            <p class="mt-4 text-gray-500 dark:text-gray-400">No upcoming bookings.</p>
                        </div>
                    @else
                        <div class="space-y-4">
                            @foreach($bookings as $booking)
                                <div class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-200">
                                    <div class="bg-gradient-to-r from-indigo-50 to-blue-50 dark:from-indigo-900/20 dark:to-blue-900/20 px-5 py-4">
                                        <div class="flex justify-between items-start">
                                            <div class="flex-1">
                                                <div class="flex items-center gap-3 mb-2">
                                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-200">
                                                        {{ ucfirst($booking->booksession ?? '—') }}
                                                    </span>
                                                    <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                                                        {{ $booking->venue->name ?? '—' }}
                                                    </h4>
                                                </div>
                                                
                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mt-3">
                                                    <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                                                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                        <span>{{ $booking->booking_date ?? 'No date' }}</span>
                                                    </div>
                                                    
                                                    <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                                                        <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                        </svg>
                                                        <span>{{ $booking->user->name ?? '—' }}</span>
                                                    </div>
                                                    
                                                    <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-300">
                                                        <svg class="w-4 h-4 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                                        </svg>
                                                        <span>{{ $booking->user->email ?? '—' }}</span>
                                                    </div>
                                                </div>

                                                @if($booking->purpose)
                                                    <div class="mt-3 flex items-start gap-2 text-sm text-gray-700 dark:text-gray-300">
                                                        <svg class="w-4 h-4 text-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                        <span><strong>Purpose:</strong> {{ $booking->purpose }}</span>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="ml-4">
                                                <button 
                                                    type="button" 
                                                    onclick="document.getElementById('cancel-form-{{ $booking->id }}').classList.toggle('hidden')" 
                                                    class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                    Cancel Booking
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="cancel-form-{{ $booking->id }}" class="hidden border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900/50 p-5">
                                        <form action="{{ route('admin.bookings.reject', $booking) }}" method="POST">
                                            @csrf
                                            <label for="reason-{{ $booking->id }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                                Reason for cancellation <span class="text-red-500">*</span>
                                            </label>
                                            <textarea 
                                                id="reason-{{ $booking->id }}" 
                                                name="reason" 
                                                rows="3" 
                                                required 
                                                placeholder="Please provide a detailed reason for cancelling this booking..."
                                                class="block w-full rounded-lg border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-200 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"></textarea>
                                            
                                            <div class="mt-4 flex gap-3">
                                                <button 
                                                    type="submit" 
                                                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                    Submit & Reject
                                                </button>
                                                <button 
                                                    type="button" 
                                                    onclick="document.getElementById('cancel-form-{{ $booking->id }}').classList.add('hidden')" 
                                                    class="px-5 py-2.5 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200">
                                                    Cancel
                                                </button>
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
    </div>
</x-app-layout>