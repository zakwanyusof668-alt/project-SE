<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'KICT Venue Booking') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Inter', sans-serif;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-blue-50 to-indigo-100 dark:from-gray-900 dark:to-gray-800">
            
            <!-- Logo Section -->
            <div class="mb-6">
                <a href="/" class="flex flex-col items-center">
                    <!-- KICT Logo Badge -->
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl flex items-center justify-center shadow-lg mb-3 hover:scale-105 transition-transform">
                        <span class="text-white font-bold text-3xl">K</span>
                    </div>
                    <!-- Text -->
                    <div class="text-center">
                        <h1 class="text-xl font-bold text-gray-900 dark:text-gray-100">KICT Venue Booking</h1>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Kulliyyah of ICT</p>
                    </div>
                </a>
            </div>

            <!-- Form Card -->
            <div class="w-full sm:max-w-md px-6 py-8 bg-white dark:bg-gray-800 shadow-xl overflow-hidden sm:rounded-xl border border-gray-200 dark:border-gray-700">
                {{ $slot }}
            </div>

            <!-- Footer Text -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600 dark:text-gray-400">
                    © {{ date('Y') }} KICT Venue Booking System
                </p>
            </div>
        </div>
    </body>
</html>