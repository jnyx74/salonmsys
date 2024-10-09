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

        @media (max-width: 768px) {
            .container {
                width: 90%;
            }
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
    <div class="container">
        <div class="header">
            <h1>JJ Hair Salon</h1>
            <p>We provide clean and affordable prices for hair services. We also offer haircuts for children and infants. Reserve your slot now and be served without delay.</p>
        </div>
        
        <form action="{{route('service.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="service">Select Services</label>
                <select id="service" name="service">
                    <option value="">Select</option>
                    <option value="haircut">Haircut</option>
                    <option value="color">Perm & Color</option>
                    <option value="treatment">Treatment</option>
                    <option value="head-spa">Head Spa</option>
                </select>
            </div>

            <div class="form-group">
                <label for="hairdresser">Select Hairdresser</label>
                <select id="hairdresser" name="hairdresser">
                    <option value="">Select</option>
                    <option value="hairdresser1">Hairdresser 1</option>
                    <option value="hairdresser2">Hairdresser 2</option>
                    <option value="hairdresser3">Hairdresser 3</option>
                </select>
            </div>

            <div class="form-group">
                <label for="dateslot">Select Available Dateslot</label>
                <select id="dateslot" name="dateslot">
                    <option value="">Select</option>
                   
                </select>
            </div>

            <div class="form-group">
                <label for="timeslot">Select Available Timeslot</label>
                <select id="timeslot" name="timeslot">
                    <option value="">Select</option>
                    <option value="10am">10:00 AM</option>
                    <option value="12pm">12:00 PM</option>
                    <option value="2pm">2:00 PM</option>
                    <option value="4pm">4:00 PM</option>
                </select>
            </div>

            <div class="form-group">
                <strong>Service:</strong>
                    <input type="text" name="service_name" id="service_name" class="form-control" placeholder="Service Name">
                        @error('service_name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
            </div>

            <div class="form-group">
                <strong>Service detail:</strong>
                    <input type="text" name="service_detail" id="service_detail" class="form-control" placeholder="Service Name">
                        @error('service_detail')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
            </div>

            <div class="form-group">
                <strong>Service detail:</strong>
                    <input type="text" name="service_category" id="service_category"  class="form-control" placeholder="Service Name">
                        @error('service_category')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
            </div>

            <div class="form-group">
                <button class="btn" type="submit">Submit</button>
            </div>
        </form>
    </div>

    </body>
</html>
