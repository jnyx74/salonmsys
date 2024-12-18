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
            /* Header Styles */
            .header-content {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px 20px;
                background-color: #fff;
                border-bottom: 1px solid #ddd;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }
            .header-content h2 {
                margin: 0;
                color: #333;
            }
            .header-content nav a {
                text-decoration: none;
                color: #555;
                margin-left: 15px;
            }
            .header-content nav a:hover {
                color: red;
            }

            /* Banner Styles */
            .banner {
                position: relative;
                text-align: center;
                color: white;
            }
            .banner img {
                width: 100%;
                height: 60vh;
                object-fit: cover;
                filter: brightness(0.6);
            }
            .banner .content {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                text-align: center;
            }
            .banner h1 {
                font-size: 3.5rem;
                text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
            }
            .banner p {
                font-size: 1.2rem;
            }
            .banner .buttons a {
                display: inline-block;
                text-decoration: none;
                color: white;
                background-color: red;
                padding: 10px 20px;
                margin: 10px;
                border-radius: 5px;
                transition: all 0.3s ease-in-out;
            }
            .banner .buttons a:hover {
                background-color: darkred;
                transform: scale(1.05);
            }
        </style>
    </head>

    <body>
        <x-app-layout>
            <x-slot name="header">
                <div class="header-content">
                    <h2 class="font-semibold text-xl">
                        {{ __('Welcome to JJ Beauty Salon!') }}
                    </h2>
                   
                </div>
            </x-slot>

            <div class="banner">
                <img src="{{ asset('image/salon.jpg') }}" alt="Salon Image">
                <div class="content">
                    <h1>Salon Reservation</h1>
                    <p>An all-in-one solution for your business, offering online booking and point-of-sale services.</p>
                    
                </div>
            </div>
        </x-app-layout>
    </body>
</html>
