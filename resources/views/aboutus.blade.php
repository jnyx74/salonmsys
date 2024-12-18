<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
                color: #333;
            }

            /* Container Styling */
            .box-container {
                display: flex;
                justify-content: center;
                align-items: center;
                gap: 20px; /* Spacing between boxes */
                padding: 50px 20px;
                flex-wrap: wrap;
            }

            /* Individual Box Styling */
            .box {
                flex: 1;
                max-width: 300px;
                background-color: #fff;
                text-align: center;
                padding: 20px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                border-radius: 10px;
                transition: transform 0.3s, box-shadow 0.3s;
            }

            .box:hover {
                transform: translateY(-10px);
                box-shadow: 0 10px 15px rgba(0, 0, 0, 0.2);
            }

            /* Icons and Title Styling */
            .box img {
                width: 60px;
                height: auto;
                margin-bottom: 15px;
            }

            .box h3 {
                font-size: 1.5rem;
                color: #dc3545; /* Red Title */
                margin: 10px 0;
            }

            .box p {
                font-size: 1rem;
                color: #6c757d;
                line-height: 1.5;
                text-align: justify;

            }
            .action-button a {
                text-align: center;
                text-decoration: none;
                color: white;
                background-color: #28a745; /* Bootstrap Success Green */
                padding: 10px 20px;
                border-radius: 5px;
                font-weight: bold;
                transition: background-color 0.3s, transform 0.2s;
            }

            .action-button a:hover {
                background-color: #218838; /* Darker Green */
                transform: scale(1.05);
            }

            /* Responsive Design */
            @media (max-width: 768px) {
                .box-container {
                    flex-direction: column;
                }
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

            <!-- Boxes Section -->
            <div class="box-container">
                <!-- Box 1 -->
                <div class="box">
                    <img src="https://cdn-icons-png.flaticon.com/512/154/154017.png" alt="Business Icon">
                    <h3>For Your Business</h3>
                    <p>An all-in-one solution for your businesses, offering a comprehensive range of business management services such as online booking.</p>
                </div>

                <!-- Box 2 -->
                <div class="box" style="background-color: #cee2ce; color: #fff;">
                    <img src="https://cdn-icons-png.flaticon.com/512/2331/2331970.png" alt="Appointment Icon">
                    <h3>Appointment Feature</h3>
                    <p>We help you manage the large daily customer traffic, improving your appointment efficiency and reducing communication costs.</p>
                </div>

                <!-- Box 3 -->
                <div class="box">
                    <img src="https://cdn-icons-png.flaticon.com/512/684/684831.png" alt="Inventory Icon">
                    <h3>Inventory Management</h3>
                    <p>Automatically deduct consumables during service, improving efficiency and reducing manual work and speedly completed the tasks.</p>
                </div>
                
        </x-app-layout>
       
            </div>
            
            
    </body>
</html>
