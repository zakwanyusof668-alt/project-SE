<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Payment & Booking Confirmation
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto bg-white dark:bg-gray-800 p-6 rounded shadow">

            <h3 class="text-lg font-bold mb-4">Booking Summary</h3>

            <div class="space-y-2 text-gray-700 dark:text-gray-300">
                <p><strong>Name:</strong> {{ $name ?? $user->name ?? '—' }}</p>
                <p><strong>Matric No:</strong> {{ $matric_no ?? '—' }}</p>
                <p><strong>Email:</strong> {{ $email ?? $user->email ?? '—' }}</p>
                <p><strong>Phone:</strong> {{ $phone ?? '—' }}</p>

                <hr class="my-3">

                <p><strong>Venue:</strong> {{ $venue->name }}</p>
                <p><strong>Location:</strong> {{ $venue->location }}</p>
                <p><strong>Booking Date:</strong> {{ $booking_date }}</p>
                <p><strong>Session:</strong> {{ isset($booksession) ? ucfirst(str_replace('_', ' ', $booksession)) : '—' }}</p>
                <p><strong>Purpose:</strong> {{ $purpose ?? '—' }}</p>

                <hr class="my-3">

                <p class="text-lg font-semibold">
                    Price: {{ $price }}
                </p>
            </div>

            <div class="mt-6 flex justify-between">
                <!-- Back button -->
                <a href="{{ url()->previous() }}"
                   class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                    Back
                </a>

                <!-- Confirm booking -->
                <form method="POST" action="{{ route('venues.confirm', $venue) }}">
                    @csrf
                    <input type="hidden" name="booking_date" value="{{ $booking_date }}">
                    <input type="hidden" name="booksession" value="{{ $booksession }}">
                    <input type="hidden" name="purpose" value="{{ $purpose }}">
                    <input type="hidden" name="name" value="{{ $name }}">
                    <input type="hidden" name="matric_no" value="{{ $matric_no }}">
                    <input type="hidden" name="email" value="{{ $email }}">
                    <input type="hidden" name="phone" value="{{ $phone }}">

                    <button type="submit"
                        class="px-5 py-2 bg-green-600 text-black rounded hover:bg-green-700">
                        Confirm Booking
                    </button>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
