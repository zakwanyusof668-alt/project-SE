<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">Admin Dashboard</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Welcome, Admin</h3>

                <div class="py-8">
                    <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                        <a href="{{ route('admin.bookings.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-green-600 text-black font-semibold rounded-lg hover:bg-green-700 transition">
                            Manage Bookings
                        </a>

                        <a href="{{ route('admin.venues.index') }}" class="inline-flex items-center justify-center px-6 py-3 bg-blue-600 text-black font-semibold rounded-lg hover:bg-blue-700 transition">
                            Manage Venues
                        </a>
                    </div>
                </div>

                <p class="mt-4">This is the admin dashboard. Use the buttons above to manage bookings and venues.</p>
            </div>
        </div>
    </div>
</x-app-layout>

