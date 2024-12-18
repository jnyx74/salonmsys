<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'JJ Beauty Salon') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <style>
        .header-link{
            display: flex;
            gap: 15px;
        }
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                {{ $header }}
                <div class="header-link">
                    @if (Route::has('login'))
                    <div>
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-800 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                     @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-800 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-800 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                     @endif
                    @endauth
                    </div>
                    @endif
                        <a href="{{ url('/profile') }}" class="profile font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-800 dark:hover:text-white">Profile</a>
                        <a href="{{ url('/aboutus') }}" class="profile font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-800 dark:hover:text-white">About</a>
                        @if (auth()->check() && auth()->user()->role != 'customer')
                        <a href="{{ route('service.index') }}" class="profile font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-800 dark:hover:text-white">Service</a>
                        <a href="{{ route('hairdresser.index') }}" class="profile font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-800 dark:hover:text-white">Hairdresser</a>
                        @endif<a href="{{ route('appointment.calendar') }}" class="profile font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-800 dark:hover:text-white">Appointment</a>
                        
                        <!-- <a href="#" class="profile font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-800 dark:hover:text-white">Cart</a> -->
                </div>
            </div>
            
            </header>
        @endif
        
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>
