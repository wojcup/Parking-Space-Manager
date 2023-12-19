<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        @vite(['resources/css/app.css','resources/js/app.js'])
    </head>
    <body class="antialiased">

        <h1>{{ config('app.name') }}</h1>
        <h1>{{ config('app.app_version') }}</h1>
        <h1>{{ config('app.app_title') }}</h1>
        <h1>{{ config('app.minimum_booking_days_from_now') }}</h1>


        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="max-w-7xl mx-auto p-6 lg:p-8 m-6 lg:m-8">
                {{-- <div class="grid grid-cols-1 md:grid-cols-1"> --}}
                <div class="full m-6 lg:m-8" style="width: 100%">
                    <div class="bg-white p-6 motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                        <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Calculate Parking Cost</h2>
                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            You may ask for the parking price. You need to provide dates ('Date From' and 'Date To')
                            For now, assume the date is today + 3 hours -> 3 days from that date, which will be
                            <br /> From: <b>{{ now()->add( '3 hours' ) }} </b> to <b>{{now()->add('2 days')->add('3 hours') }}</b>
                        </p>
                    </div>
                </div>
                
                <div class="full m-6 lg:m-8" style="width: 100%">
                    <div class="bg-white p-6 motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
                        <h2 class="mt-6 text-xl font-semibold text-gray-900 dark:text-white">Available Parking Place</h2>
                        <p class="mt-4 text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                            This should show all available slots (parking places) within the given time frame:
                            <br /> From: <b>{{ now()->add( '3 hours' ) }} </b> to <b>{{now()->add('2 days')->add('3 hours') }}</b>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
