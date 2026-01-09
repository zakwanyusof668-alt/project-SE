<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">Manage Venues</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Venues</h3>
                {{-- Add venue form --}}
                <div class="mb-6">
                    <form action="{{ route('admin.venues.store') }}" method="POST" class="grid grid-cols-1 sm:grid-cols-4 gap-3 items-end">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Name</label>
                            <input name="name" required class="mt-1 block w-full rounded-md border-gray-300" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Location</label>
                            <input name="location" class="mt-1 block w-full rounded-md border-gray-300" />
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Capacity</label>
                            <input name="capacity" type="number" class="mt-1 block w-full rounded-md border-gray-300" />
                        </div>
                        <div>
                            <button type="submit" class="px-4 py-2 bg-green-600 text-black rounded">Add Venue</button>
                        </div>
                    </form>
                </div>

                @if($venues->isEmpty())
                    <p>No venues found.</p>
                @else
                    <div class="space-y-4">
                        @foreach($venues as $venue)
                            <div class="p-4 border rounded">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <div class="font-semibold">{{ $venue->name }}</div>
                                        <div class="text-sm text-gray-600">Location: {{ $venue->location ?? '—' }}</div>
                                        <div class="text-sm text-gray-600">Capacity: {{ $venue->capacity ?? '—' }}</div>
                                        @if($venue->unavailableDates->isNotEmpty())
                                            <div class="mt-2 text-sm text-red-600">Unavailable dates: 
                                                {{ $venue->unavailableDates->pluck('date')->implode(', ') }}
                                            </div>
                                        @endif
                                    </div>

                                    <div class="text-right space-y-2">
                                        <form action="{{ route('admin.venues.destroy', $venue) }}" method="POST" onsubmit="return confirm('Delete this venue? This cannot be undone if there are no bookings.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded">Delete Venue</button>
                                        </form>

                                        {{-- Add unavailable date form --}}
                                        <form action="{{ route('admin.venues.unavailable.store', $venue) }}" method="POST" class="mt-2">
                                            @csrf
                                            <label class="block text-sm text-gray-600">Mark unavailable date</label>
                                            <div class="flex gap-2 mt-1">
                                                <input type="date" name="date" required class="rounded border-gray-300" />
                                                <button type="submit" class="px-3 py-1 bg-yellow-500 text-black rounded">Add</button>
                                            </div>
                                        </form>

                                        @if($venue->unavailableDates->isNotEmpty())
                                            <div class="mt-2">
                                                @foreach($venue->unavailableDates as $un)
                                                    <form action="{{ route('admin.venues.unavailable.destroy', [$venue, $un]) }}" method="POST" class="inline-block mr-2">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-sm text-red-600">Remove {{ $un->date }}</button>
                                                    </form>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
