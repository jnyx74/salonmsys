<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Salon Dashboard') }}
        </h2>
    </x-slot>

    <style>
    /* Quick CSS to visualize structure */
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f6f9;
    }

    .dashboard {
      padding: 20px;
    }

    .overview {
      display: flex;
      gap: 20px;
      margin-bottom: 30px;
    }

    .card {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 20px;
      flex: 1;
      text-align: center;
    }

    .appointments {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
    }

    .appointment-card {
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 20px;
      text-align: center;
    }

    .appointment-card img {
      border-radius: 50%;
      width: 80px;
      height: 80px;
      margin-bottom: 10px;
    }

    .view-details {
      margin-top: 10px;
      display: inline-block;
      padding: 10px 20px;
      background-color: #6c63ff;
      color: #fff;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>
  <div class="dashboard">
    <div class="overview">
      <div class="card">
        <h3>Appointments</h3>
        <p><strong>{{$total_appointment}}</strong> Today</p>
      </div>
      <div class="card">
        <h3>Cancelled</h3>
        <p><strong>{{$total_service}}</strong> Today</p>
      </div>
      <div class="card">
        <h3>Service</h3>
        <p><strong>{{$total_service}}</strong> in Total</p>
      </div>
      <div class="card">
        <h3>Hairdresser</h3>
        <p><strong>{{$total_hairdresser}}</strong>  in Total</p>
      </div>
    </div>

    <h2>Today's Appointments</h2>
    <div class="appointments">
        @forelse ($appointments as $appointment)
            <div class="appointment-card">
                <img src="https://i.pinimg.com/736x/18/1e/f2/181ef2b17916a4ac581b47b72295808f.jpg" alt="Profile">
                <h4>{{ $appointment->name }}</h4>
                <p>Appointment Date: {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }}</p>
                <p>Time: {{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</p>
                <a href="#" class="view-details">View Details</a>
            </div>
        @empty
            <p>No appointments for today.</p>
        @endforelse
    </div>
  </div>
</x-app-layout>
