<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('About Us') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
           <div class="flex flex-col items-center justify-center gap-0 mb-12">
    <img 
        src="{{ asset('images/logo.png') }}" 
        alt="KICT Logo" 
        class="w-60 h-60 object-contain -mb-10"
    >

    <h1 class="text-4xl font-bold text-gray-900 dark:text-gray-100">
        KictVeBook
    </h1>

    <p class="text-lg text-gray-600 dark:text-gray-400 mt-1">
        Kulliyyah of ICT Venue Booking System
    </p>
</div>


            <!-- Main Content -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                <div class="p-8">
                    
                    <!-- What is KictVeBook -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4 flex items-center">
                            <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            What is KictVeBook?
                        </h2>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            KictVeBook is the official venue booking system for the Kulliyyah of Information and Communication Technology (KICT). 
                            Our platform simplifies the process of reserving classrooms, halls, and other facilities within the kulliyyah, 
                            making it easier for students, faculty, and staff to organize events and activities.
                        </p>
                    </div>

                    <!-- Our Mission -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4 flex items-center">
                            <svg class="w-6 h-6 text-indigo-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Our Mission
                        </h2>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            To provide a streamlined, efficient, and user-friendly platform for managing venue bookings at KICT, 
                            ensuring that our facilities are utilized effectively and accessible to all members of our community.
                        </p>
                    </div>

                    <!-- Key Features -->
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4 flex items-center">
                            <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                            Key Features
                        </h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mt-1">
                                    <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 dark:text-gray-100">Easy Booking</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Quick and simple venue reservation process</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mt-1">
                                    <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 dark:text-gray-100">Real-time Availability</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Check venue availability instantly</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mt-1">
                                    <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 dark:text-gray-100">Booking Management</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">View and manage your reservations</p>
                                </div>
                            </div>

                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 w-6 h-6 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mt-1">
                                    <svg class="w-4 h-4 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 dark:text-gray-100">Admin Controls</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-400">Efficient venue and booking administration</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 rounded-lg p-6 border border-blue-200 dark:border-blue-800">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-3 flex items-center">
                            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            Need Help?
                        </h2>
                        <p class="text-gray-600 dark:text-gray-400">
                            For any inquiries or assistance with the booking system, please contact the KICT administration office.
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>