<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">
            Book Venue
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow">

            <h3 class="text-lg font-bold mb-4">
                {{ $venue->name }}
            </h3>

            <form method="POST" action="{{ route('venues.review', $venue) }}">
                @csrf
                {{-- If date/session were provided from search, include them as hidden inputs so user
                    doesn't have to re-enter them. Otherwise show the inputs so user can pick. --}}
                @if(request()->filled('date'))
                    <input type="hidden" name="booking_date" value="{{ request('date') }}">
                @else
                    <div class="mb-4">
                        <label class="block mb-1">Booking Date</label>
                        <input type="date"
                           name="booking_date"
                           min="{{ now()->toDateString() }}"
                           required
                           class="border rounded px-3 py-2">
                    </div>
                @endif

                @if(request()->filled('booksession'))
                    <input type="hidden" name="booksession" value="{{ request('booksession') }}">
                @else
                    <div class="mb-4">
                        <label class="block mb-1">Session</label>
                        <select name="booksession"
                                required
                                class="w-full border rounded px-3 py-2">
                            <option value="">-- Select session --</option>
                            <option value="morning">Morning (7:00 – 12:00)</option>
                            <option value="evening">Evening (13:00 – 18:00)</option>
                            <option value="all_day">All Day (7:00 – 18:00)</option>
                        </select>

                        @error('booksession')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>
                @endif
                

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block mb-1">Full name</label>
                        <input type="text" name="name" required
                               value="{{ old('name', auth()->user()->name ?? '') }}"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block mb-1">Matric No</label>
                        <input type="text" name="matric_no" required
                               value="{{ old('matric_no') }}"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block mb-1">Email</label>
                        <input type="email" name="email" required
                               value="{{ old('email', auth()->user()->email ?? '') }}"
                               class="w-full border rounded px-3 py-2">
                    </div>

                    <div>
                        <label class="block mb-1">Phone No</label>
                        <input type="text" name="phone" required
                               value="{{ old('phone') }}"
                               class="w-full border rounded px-3 py-2">
                    </div>
                </div>

               


                <div class="mb-4">
                    <label class="block mb-1">Purpose</label>
                    <textarea name="purpose"
                              class="w-full border rounded px-3 py-2"></textarea>
                </div>

                <div class="flex justify-between">
                    <a href="{{ route('SearchVenues.Sindex') }}"
                       class="px-4 py-2 bg-gray-500 text-white rounded">
                        Cancel
                    </a>

                    <button type="submit"
                            class="px-4 py-2 bg-gray-600 text-black rounded">
                        Proceed
                    </button>

                    @if (!empty($unavailableDates))
                       <p class="text-sm text-red-600 mb-2">
                           Unavailable dates:
                             {{ implode(', ', $unavailableDates) }}
                       </p>
                    @endif

                    @error('booking_date')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                    </p>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
