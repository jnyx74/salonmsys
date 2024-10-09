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
            background-color: #f8f9f1;
        }
        .banner {
            position: relative;
            text-align: center;
            color: white;
        }
        .section {
            position: relative;
            text-align: center;
            color: black;
        }
        .banner img {
            width: 100%;
            height: auto;
        }
        .banner .content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        .banner h1 {
            font-size: 3rem;
            margin: 0;
        }
        .banner p {
            font-size: 1.25rem;
        }
        .banner .buttons {
            margin-top: 20px;
        }
        .banner .buttons a {
            text-decoration: none;
            color: white;
            background-color: red;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 5px;
        }
        /* New styles for the header layout */
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }
        
        </style>
    </head>
    
    <body>
        <x-app-layout>
            <x-slot name="header">
                <div class="header-content">
                    <!-- Left side: Title -->
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                        {{ __('Welcome to JJ Beauty Salon!') }}
                    </h2>
                </div>
            </x-slot>

            <div class="banner">
                <img src="image/salon.jpg" alt="Salon Image">
                <div class="content">
                    <h1>Salon Reservation System</h1>
                    <p>An all-in-one solution for your businesses, offering a comprehensive range of business management services such as online booking and point-of-sale transactions.</p>
                    <div class="buttons">
                        <a href="#">Pick Salon</a>
                        <a href="{{ route('service.index') }}">Services</a>
                    </div><br><br><br>
                    <p>Save Time & Costs, Improve Efficiency When Running</p>
                <p>Your Spa/Salon</p>
                <p>Our features help make your daily tasks easier, so you have more time to focus on your customer.</p>
                </div>
            </div>
            
            
        </x-app-layout>
    </body>
</html>
