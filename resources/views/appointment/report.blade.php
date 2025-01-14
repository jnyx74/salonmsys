<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Analysis</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .filter-form {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: center;
            margin: 20px auto;
            padding: 15px;
            max-width: 800px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        
        .filter-form label {
            font-size: 14px;
            font-weight: bold;
        }
        
        .filter-form input {
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            outline: none;
        }
        
        .filter-form button {
            padding: 10px 20px;
            font-size: 14px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .filter-form button:hover {
            background-color: #0056b3;
        }

        .report-container {
            padding: 20px;
            background-color: #fff;
            margin: 20px auto;
            max-width: 1000px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
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

        table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .summary {
            margin-top: 20px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }

        canvas {
            max-width: 100%;
            height: auto;
        }

        .chart-title {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 600;
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
    <div class="report-container">
        <table>
            <thead>
                <tr>
                    <th>Period</th>
                    <th>Total Price (RM)</th>
                    <th>Total Customer</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Total</td>
                    <td>{{ $totalPrice }}</td>
                    <td>{{ $totalRecords }}</td>
                </tr>
            </tbody>
        </table>

        <!-- Chart -->
        <canvas id="reportChart"></canvas>
    </div>
</x-app-layout>

<script>
    // Data for the chart
    const chartLabels = {!! json_encode($chartLabels) !!}; // Labels (e.g., 'January', 'February')
    const chartData = {!! json_encode($chartData) !!}; // Data for the graph (e.g., total price or customers)

    const ctx = document.getElementById('reportChart').getContext('2d');
    const reportChart = new Chart(ctx, {
        type: 'bar', // You can use 'line', 'pie', etc.
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Total Price (RM)',
                data: chartData,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Report Analysis'
                }
            }
        }
    });
</script>
</body>
</html>
