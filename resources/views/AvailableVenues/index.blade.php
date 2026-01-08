<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Available Venues
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6">
                @forelse ($venues as $venue)
                    <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow">
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
                @empty
                    <p class="text-gray-600 dark:text-gray-400">
                        No venues available at the moment.
                    </p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>