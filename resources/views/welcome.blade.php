<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KICT Venue Booking System</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="antialiased bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-20 h-20 flex items-center justify-center">
                        <img src="{{ asset('images/logo.png') }}" alt="KICT Logo" class="w-20 h-20 object-contain">
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">KictVeBook</h1>
                        <p class="text-xs text-gray-500">Kulliyyah of ICT Venue Booking System</p>
                    </div>
                </div>

                <!-- Auth Links -->
                @if (Route::has('login'))
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="px-4 py-2 text-gray-700 hover:text-gray-900 font-medium transition">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-4 py-2 text-gray-700 hover:text-gray-900 font-medium transition">
                                Log in
                            </a>
                            
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium transition">
                                    Register
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-20">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div>
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6">
                    Book Your <span class="text-indigo-600">Venue</span> with Ease
                </h2>
                <p class="text-lg text-gray-600 mb-8">
                    The complete venue booking system for KICT. Reserve conference halls, meeting rooms, computer labs, and more in just a few clicks.
                </p>
                
                <div class="flex flex-col sm:flex-row gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-8 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold text-center transition shadow-lg hover:shadow-xl">
                            Go to Dashboard
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="px-8 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-semibold text-center transition shadow-lg hover:shadow-xl">
                            Get Started
                        </a>
                        <a href="{{ route('login') }}" class="px-8 py-3 bg-white text-indigo-600 rounded-lg hover:bg-gray-50 font-semibold text-center transition border-2 border-indigo-600">
                            Sign In
                        </a>
                    @endauth
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-6 mt-12">
                    <div>
                        <div class="text-3xl font-bold text-indigo-600">20+</div>
                        <div class="text-sm text-gray-600">Venues</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-indigo-600">500+</div>
                        <div class="text-sm text-gray-600">Bookings</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-indigo-600">100+</div>
                        <div class="text-sm text-gray-600">Users</div>
                    </div>
                </div>
            </div>

            <!-- Right Content - Feature Cards -->
            <div class="grid grid-cols-1 gap-6">
                <!-- Feature Card 1 -->
                <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Easy Booking</h3>
                    <p class="text-gray-600">Select your preferred date, time, and venue in seconds</p>
                </div>

                <!-- Feature Card 2 -->
                <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Real-time Availability</h3>
                    <p class="text-gray-600">Check venue availability instantly and avoid conflicts</p>
                </div>

                <!-- Feature Card 3 -->
                <div class="bg-white rounded-lg shadow-lg p-6 transform hover:scale-105 transition">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Manage Bookings</h3>
                    <p class="text-gray-600">View, edit, or cancel your bookings anytime</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Available Venues Section -->
    <div class="bg-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Available Venue Types</h2>
                <p class="text-lg text-gray-600">Choose from our wide range of venues for your needs</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Venue Type 1 -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg p-6 text-center hover:shadow-lg transition">
                    <div class="text-4xl mb-3">🏛️</div>
                    <h3 class="font-semibold text-gray-900 mb-2">Conference Halls</h3>
                    <p class="text-sm text-gray-600">Large capacity venues for conferences and seminars</p>
                </div>

                <!-- Venue Type 2 -->
                <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg p-6 text-center hover:shadow-lg transition">
                    <div class="text-4xl mb-3">🚪</div>
                    <h3 class="font-semibold text-gray-900 mb-2">Meeting Rooms</h3>
                    <p class="text-sm text-gray-600">Perfect for small group discussions and meetings</p>
                </div>

                <!-- Venue Type 3 -->
                <div class="bg-gradient-to-br from-purple-50 to-pink-50 rounded-lg p-6 text-center hover:shadow-lg transition">
                    <div class="text-4xl mb-3">💻</div>
                    <h3 class="font-semibold text-gray-900 mb-2">Computer Labs</h3>
                    <p class="text-sm text-gray-600">Equipped labs for practical sessions and workshops</p>
                </div>

                <!-- Venue Type 4 -->
                <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-lg p-6 text-center hover:shadow-lg transition">
                    <div class="text-4xl mb-3">📚</div>
                    <h3 class="font-semibold text-gray-900 mb-2">Tutorial Rooms</h3>
                    <p class="text-sm text-gray-600">Ideal for tutorials and small class sessions</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-xl">K</span>
                        </div>
                        <div>
                            <h3 class="font-bold">KICT Venue Booking</h3>
                            <p class="text-xs text-gray-400">Kulliyyah of ICT</p>
                        </div>
                    </div>
                    <p class="text-gray-400 text-sm">Simplifying venue management for KICT community</p>
                </div>

                <div>
                 
                </div>

                <div>
                    <h4 class="font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li>📧 VeBook@kict.iium.edu.my</li>
                        <li>📞 +60 3-9099-1234</li>
                        <li>📍 KICT, IIUM Gombak</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-400">
                <p>&copy; {{ date('Y') }} KICT Venue Booking System. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>