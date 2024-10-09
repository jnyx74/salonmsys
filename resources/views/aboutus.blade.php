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
            height: 30%;
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

        .about-us-section {
            padding: 50px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .about-us-section h2 {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .about-us-section hr {
            width: 50px;
            border: 2px solid #ffc107;
            margin: 20px auto;
        }
        .about-us-section .content h3,
        .about-us-section .content h4 {
            font-size: 24px;
            font-weight: bold;
            color: #212529;
            margin-top: 30px;
        }
        .about-us-section .content p {
            font-size: 16px;
            color: #6c757d;
            margin: 10px 0;
            line-height: 1.8;
        }
        .action-button a {
            text-decoration: none;
            color: white;
            background-color: #007bff;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
        }
        </style>
    </head>
    <body>
    <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('About Us') }}
        </h2>
    </x-slot>
        

        <div class="container d-flex justify-content-center align-items-center" style="min-height: 80vh;">
            <div class="about-us-section text-center">
               
                <div class="content">
                    <h3>For Your Business</h3>
                    <p>An all-in-one solution for your businesses, offering a comprehensive range of business management services such as online booking and point-of-sale transactions.</p>
                    
                    <h4>Appointment Feature</h4>
                    <p>We help you manage the large daily customer traffic, improving your appointment efficiency and reducing communication costs.</p>
                    
                    <h4>Inventory Consumption Management</h4>
                    <p>We solve the issue of associated product consumption. When serving customers, you no longer need to manually deduct consumables. The software automatically deducts associated consumables, enhancing store operational efficiency and reducing labor costs.</p>
                </div>
                <div class="action-button mt-4">
                    <a href="{{route ('service.index') }}" class="btn btn-primary">Pick Salon</a>
                </div>
            </div>
        </div>
    </x-app-layout>
    </body>
</html>
