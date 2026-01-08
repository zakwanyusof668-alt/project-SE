<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Search Venues
        </h2>
    </x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <form method="GET" action="{{ route('SearchVenues.Sindex') }}" class="mb-6">
    <div class="flex gap-3 items-center">

        <input
            type="text"
            name="q"
            value="{{ request('q') }}"
            placeholder="Search venue name or location..."
            class="flex-1 px-3 py-2 border rounded-lg
                   focus:outline-none focus:ring focus:border-blue-400"
        >

        <input
            type="date"
            name="date"
            value="{{ request('date') }}"
            min="{{ now()->toDateString() }}"
            class="px-3 py-2 border rounded-lg"
        >

        <select name="booksession" class="px-3 py-2 border rounded-lg">
            <option value="">Any session</option>
            <option value="morning" {{ request('booksession') == 'morning' ? 'selected' : '' }}>Morning</option>
            <option value="evening" {{ request('booksession') == 'evening' ? 'selected' : '' }}>Evening</option>
            <option value="all_day" {{ request('booksession') == 'all_day' ? 'selected' : '' }}>All Day</option>
        </select>

        <button
            type="submit"
            class="px-4 py-2 bg-blue-600 text-black rounded-lg
                   hover:bg-blue-700 transition"
        >
            Search
        </button>

    </div>
</form>


        <div class="space-y-6">
            @forelse ($venues as $venue)
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow
                            flex flex-col sm:flex-row sm:items-center sm:justify-between">

                    <div>
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                            {{ $venue->name }}
                        </h2>
                        <p class="text-gray-600 dark:text-gray-400 mt-1">
                            Capacity: {{ $venue->capacity }} people
                        </p>
                        <p class="text-gray-600 dark:text-gray-400">
                            Location: {{ $venue->location }}
                        </p>
                        
                    </div>

                    <a href="{{ route('venues.book', array_merge(['venue' => $venue], request()->only(['date','booksession']))) }}"
                       class="mt-4 sm:mt-0 px-5 py-2 bg-blue-600 text-green rounded
                              hover:bg-blue-700 transition">
                        Book Venue
                    </a>
                </div>
            @empty
                <p class="text-gray-600 dark:text-gray-400">
                    No venues available at the moment.
                </p>
            @endforelse
        </div>
        
    </div>
</div>
</x-app-layout>

