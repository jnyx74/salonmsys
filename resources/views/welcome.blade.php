<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>JJ Beauty Salon</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
           body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: white;
            padding: 10px 20px;
        }
        .navbar a {
            color: dark;
            text-decoration: none;
            margin: 0 10px;
        }
        .navbar .location {
            display: flex;
            align-items: center;
        }
        .navbar .location span {
            margin-left: 5px;
            color: #ffc107;
        }
        .hero {
            position: relative;
            text-align: center;
            color: white;
        }
        .hero img {
            width: 100%;
            height: auto;
        }
        .hero .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .hero h1 {
            font-size: 3rem;
            margin: 0;
        }
        .hero p {
            font-size: 1.25rem;
        }
        .hero .buttons {
            margin-top: 20px;
        }
        .hero .buttons a {
            text-decoration: none;
            color: white;
            background-color: red;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 5px;
        }
        </style>
    </head>
    <body >
        
            <div class="navbar">
    <a href="#" class="logo"><img src="image/salon_logo.png" alt="Salon Image" style="width:10%;height:10%"></a>
    <div class="location">
        <span>Location:</span>
        <span>Kuching, Sarawak</span>
    </div>
    <div class="links">
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Services</a>
        <a href="#">Notification</a>
        <a href="#" class="cart">Cart</a>
        <a href="#" class="profile">Profile</a>
    </div>
</div>

<div class="hero">
    <img src="image/salon.jpg" alt="Salon Image">
    <div class="content">
        <h1>Salon Reservation System</h1>
        <p>An all-in-one solution for your businesses, offering a comprehensive range of business management services such as online booking and point-of-sale transactions.</p>
        <div class="buttons">
            <a href="#">Pick Salon</a>
            <a href="#">Services</a>
        </div>
    </div>
</div>
        </div>
    </body>
</html>
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
