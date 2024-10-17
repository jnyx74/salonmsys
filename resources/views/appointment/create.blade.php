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
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
        }

        .header {
            text-align: center;
            padding-bottom: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 2rem;
        }

        .header p {
            font-size: 1rem;
            color: #555;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        select {
            width: 100%;
            padding: 10px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f1f1f1;
        }

        .btn-cart {
            display: inline-block;
            background-color: #333;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            text-align: center;
        }

        .btn-cart:hover {
            background-color: #555;
        }
        .btn {
            background-color: #4CAF50; /* Green */
            border: none;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
            }
        }
        </style>
    </head>
    <body>
    <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(' Create New Appointment') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="header">
            <h1>JJ Hair Salon-New Appointment</h1>
        </div>
        
        <form action="{{route('appointment.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" style="width:100%">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
            </div>

            <div class="form-group">
                <label for="phone">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" style="width:100%">
                            @error('phone')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <input type="time" name="status" id="status" class="status" style="width:100%">
                @error('status')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="service_id">Service Name</label>
                <select name="service_id" id="service_id" class="form-control" style="width:100%">
                    <option value="" disabled selected>Select a service</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                    @endforeach
                </select>
                @error('service_id')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="hairdresser_id">Hairdresser Name</label>
                <select name="hairdresser_id" id="hairdresser_id" class="form-control" style="width:100%">
                    <option value="" disabled selected>Select a hairdresser</option>
                    @foreach($hairdressers as $hairdresser)
                        <option value="{{ $hairdresser->id }}">{{ $hairdresser->name }}</option>
                    @endforeach
                </select>
                @error('hairdresser_id')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="appointment_date">Appointment Date</label>
                <input type="date" name="appointment_date" id="appointment_date" class="appointment_date" style="width:100%">
                @error('appointment_date')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="appointment_time">Appointment Time</label>
                <input type="time" name="appointment_time" id="appointment_time" class="appointment_time" style="width:100%">
                @error('appointment_time')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <button class="btn" type="submit">Submit</button>
            </div>
        </form>
    </div>
    </x-app-layout>
    </body>
</html>
