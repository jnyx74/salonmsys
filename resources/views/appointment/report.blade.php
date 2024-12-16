<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Analysis</title>
     <!-- Fonts -->
     <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
   
      
        .filter-form {
            margin-bottom: 20px;
        }
        .filter-form input {
            padding: 10px;
            margin-right: 10px;
            font-size: 14px;
        }
        .filter-form button {
            padding: 10px 15px;
            font-size: 14px;
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }
        .filter-form button:hover {
            background-color: #0056b3;
        }
        
        .report-banner {
                position: relative;
                width: 100%;
                height: 300px;
                background: url('image/report.jpg') no-repeat center center/cover;
                text-align: center;
                color: white;
            }

            .report-banner .banner-content {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background-color: rgba(0, 0, 0, 0.7);
                padding: 20px 40px;
                border-radius: 5px;
            }

            .report-banner h1 {
                font-size: 36px;
                margin: 0;
            }

            .report-container {
                padding: 20px;
                background-color: #fff;
                margin: 20px;
                border-radius: 10px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            }

            h2 {
                text-align: center;
                margin-bottom: 20px;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
            }

            table th, table td {
                padding: 10px;
                text-align: left;
                border-bottom: 1px solid #ddd;
            }

            table th {
                background-color: #f4f4f4;
                font-weight: bold;
            }

            table tbody tr:nth-child(even) {
                background-color: #f9f9f9;
            }

            .summary {
                margin-top: 20px;
                text-align: center;
                font-size: 18px;
                font-weight: bold;
            }
    </style>
</head>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Report Analysis') }}
        </h2>
    </x-slot>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('appointment.report') }}" class="filter-form">
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" value="{{ request('start_date', $startDate) }}">
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" value="{{ request('end_date', $endDate) }}">
            <button type="submit">Filter</button>
        </form>

        <!-- Report Table -->
        <table>
        <thead>
                <tr>
                    <th>Period</th>
                    <th>Total Price (RM)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Daily</td>
                    <td>{{ $dailyTotal }}</td>
                </tr>
                <tr>
                    <td>Monthly</td>
                    <td>{{ $monthlyTotal }}</td>
                </tr>
                <tr>
                    <td>Yearly</td>
                    <td>{{ $yearlyTotal }}</td>
                </tr>
            </tbody>
        </table>
        <div class="summary">
            Overall Total Price: RM {{ $overallTotal }}
        </div>
    </div></x-app-layout>
</body>
</html>
