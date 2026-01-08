<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

    <h1 class="text-2xl font-bold mb-6">
        Welcome, {{ Auth::user()->name }}
    </h1>

    <div class="flex flex-col sm:flex-row gap-4">

        <!-- List of Venues -->
        <a href="{{ route('AvailableVenues.index') }}"
   class="inline-flex items-center justify-center px-6 py-3 
          bg-transparent text-blue-700 font-semibold rounded-lg
          border-2 border-blue-600
          hover:bg-blue-600 hover:text-black
          transition">
    List of Venues
</a>

        <!-- Search Venues -->
        <a href="{{ route('SearchVenues.Sindex') }}" 
           class="inline-flex items-center justify-center px-6 py-3 bg-green-600 text-black font-semibold rounded-lg hover:bg-green-700 transition">
            Search Venues
        </a>

        <!-- My Bookings -->
        <a href="{{ route('bookings.index') }}"
           class="inline-flex items-center justify-center px-6 py-3 bg-green-600 text-black font-semibold rounded-lg hover:bg-green-700 transition">
            My Bookings
        </a>

    </div>

</div>
            </div>
        </div>
    </div>
</x-app-layout>
