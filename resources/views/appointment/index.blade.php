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
        .appoinment-banner {
            position: relative;
            width: 100%;
            height: 400px;
            background: url('image/salon.jpg') no-repeat center center/cover;
        }

        .appoinment-banner .banner-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px 40px;
            border-radius: 5px;
        }

        .appoinment-banner h1 {
            color: #fff;
            font-size: 36px;
            margin: 0;
        }

        .appointment-buttons {
            display: flex;
            justify-content: center;
            padding: 20px;
            background-color: #fff;
        }

        .appointment-buttons .btn {
            background-color: #000;
            color: #fff;
            padding: 10px 30px;
            border: none;
            border-radius: 50px;
            margin: 0 10px;
            font-size: 16px;
            cursor: pointer;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .appointment-buttons .btn:hover {
            background-color: #333;
        }

        /* Table styling */
        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        table th, table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        table th {
            background-color: #f4f4f4;
            color: #333;
            font-weight: bold;
        }
        table tbody tr:hover {
            background-color: #f9f9f9;
        }
        table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table td .btn {
            padding: 5px 10px;
            font-size: 14px;
            border-radius: 5px;
            text-decoration: none;
            margin-right: 5px;
        }
        table td .btn-primary {
            background-color: #007bff;
            color: #fff;
            border: none;
            transition: background-color 0.3s ease;
        }
        table td .btn-primary:hover {
            background-color: #0056b3;
        }
        table td .btn-danger {
            background-color: #dc3545;
            color: #fff;
            border: none;
            transition: background-color 0.3s ease;
        }
        table td .btn-danger:hover {
            background-color: #c82333;
        }
        </style>
    </head>
    <body>
    <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer Appointment') }}
        </h2>
    </x-slot>

            <!-- appoinment Banner -->
            <div class="appoinment-banner">
                <div class="banner-content">
                    <h1>Appointment list</h1>
                </div>
            </div>

            <!-- appointment Buttons -->
            <div class="appointment-buttons">
                <a href="{{ route('appointment.create') }}" class="btn">New Appointment</a>
             
            </div>

            <!-- appointment Table -->
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Customer Phone</th>
                        <th>Appointment Date</th>
                        <th>Appointment Time</th>
                        <th>Created</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                        <tr>
                            <td>{{ $appointment->id }}</td>
                            <td>{{ $appointment->name }}</td>
                            <td>{{ $appointment->phone }}</td>
                            <td>{{ $appointment->appointment_date }}</td>
                            <td>{{ $appointment->appointment_time }}</td>
                            <td>{{ $appointment->created_at }}</td>
                            <td>{{ $appointment->status }}</td>
                            <td>
                                <a href="{{ route('appointment.edit',$appointment->id) }}" class="btn btn-primary">Edit</a>
                                <form action="#" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </x-app-layout>
    </body>
</html>
