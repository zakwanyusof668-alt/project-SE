<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">Manage Venues</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Venues</h3>

                @if($venues->isEmpty())
                    <p>No venues found.</p>
                @else
                    <div class="space-y-4">
                        @foreach($venues as $venue)
                            <div class="p-4 border rounded">
                                <div class="font-semibold">{{ $venue->name }}</div>
                                <div class="text-sm text-gray-600">Location: {{ $venue->location ?? '—' }}</div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
