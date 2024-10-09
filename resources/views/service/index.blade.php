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
        .services-banner {
            position: relative;
            width: 100%;
            height: 400px;
            background: url('image/salon.jpg') no-repeat center center/cover;
        }

        .services-banner .banner-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.7);
            padding: 20px 40px;
            border-radius: 5px;
        }

        .services-banner h1 {
            color: #fff;
            font-size: 36px;
            margin: 0;
        }

        .service-buttons {
            display: flex;
            justify-content: center;
            padding: 20px;
            background-color: #fff;
        }

        .service-buttons .btn {
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

        .service-buttons .btn:hover {
            background-color: #333;
        }
        </style>
    </head>
    <body>
        
        <div class="navbar">
            <a href="#" class="logo"><img src="image/salon_logo.png" alt="Salon Image" style="width:10%;height:10%"></a>
            <div class="location">
                <span>Location:</span>
                <span>Kuching, Sarawak</span>
            </div>
            <div class="links">
                <a href="#">Home</a>
                <a href="{{ url('/aboutus') }}">About</a>
                <a href="#">Services</a>
                <a href="#">Notification</a>
                <a href="#" class="cart">Cart</a>
                <a href="{{ url('/profile') }}" class="profile">Profile</a>
            </div>
        </div>

            <!-- Services Banner -->
            <div class="services-banner">
                <div class="banner-content">
                    <h1>Our Hair Services</h1>
                </div>
            </div>

            <!-- Service Buttons -->
            <div class="service-buttons">
                <a href="{{ route('service.create') }}" class="btn">HAIRCUT</a>
                <a href="#" class="btn">PERM & COLOUR</a>
                <a href="#" class="btn">TREATMENT</a>
                <a href="#" class="btn">HEAD SPA</a>
            </div>

            <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Service Name</th>
                <th>Service Detail</th>
                <th>Service Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($services as $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td>{{ $service->service_name }}</td>
                    <td>{{ $service->service_detail }}</td>
                    <td>{{ $service->service_category }}</td>
                    <td>
                        <a href="#" class="btn btn-primary">Edit</a>
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

    </body>
</html>
