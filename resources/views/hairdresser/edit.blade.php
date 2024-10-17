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
            {{ __(' Edit Hairdresser Detail') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="header">
            <h1>JJ Hair Salon-Edit Hairdresser Detail</h1>
        </div>
        
        <form action="{{route('hairdresser.update',$hairdresser->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
            <div class="form-group">
                <label for="hairdresser">Name</label>
                <input type="text" name="name" id="name" class="form-control" style="width:100%" value="{{ $hairdresser->name }}">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
            </div>

            <div class="form-group">
                <label for="hairdresser">Email</label>
                <input type="text" name="email" id="email" class="form-control" style="width:100%" value="{{ $hairdresser->email }}">
                        @error('email')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
            </div>

            <div class="form-group">
                <label for="hairdresser">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control" style="width:100%" value="{{ $hairdresser->phone }}">
                            @error('phone')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
            </div>

            <div class="form-group">
                <label for="hairdresser">Position</label>
                    <input type="text" name="position" id="position" class="form-control" style="width:100%" value="{{ $hairdresser->position }}">
                            @error('position')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
            </div>

            <div class="form-group">
                <label for="hairdresser">Job description</label>
                    <textarea type="text" name="job_description" id="job_description" class="form-control" style="width:100%" value="{{ $hairdresser->job_description }}"></textarea>
                            @error('job_description')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
            </div>

            <div class="form-group">
                <button class="btn" type="submit">Update</button>
            </div>
        </form>
    </div>
    </x-app-layout>
    </body>
</html>
