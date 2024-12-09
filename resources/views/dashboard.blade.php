<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Salon Dashboard') }}
        </h2>
    </x-slot>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <style>
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

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    table, th, td {
      border: 1px solid #ddd;
    }

    th, td {
      padding: 12px;
      text-align: left;
    }

    th {
      background-color: #6c63ff;
      color: white;
    }

    tbody tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    tbody tr:nth-child(odd) {
      background-color: #ffffff;
    }

    tbody tr:hover {
      background-color: #e0e0e0;
    }

    .view-details {
      padding: 10px 20px;
      background-color: #6c63ff;
      color: #fff;
      border: none;
      border-radius: 5px;
      text-decoration: none;
      font-weight: bold;
    }

    .view-details:hover {
      background-color: #5a52e2;
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
                <h3>Incoming Appointments</h3>
                <p><strong>{{$total_incoming_appointments}}</strong> in Total</p>
            </div>
            <div class="card">
                <h3>Cancelled</h3>
                <p><strong>{{$total_cancelled}}</strong> in Total</p>
            </div>
            <div class="card">
                <h3>Service</h3>
                <p><strong>{{$total_service}}</strong> in Total</p>
            </div>
            <div class="card">
                <h3>Hairdresser</h3>
                <p><strong>{{$total_hairdresser}}</strong> in Total</p>
            </div>
        </div>

        <!-- Today's Appointments Section -->
        <h2>Today's Appointments</h2>
        <table>
            <thead>
                <tr>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Service Name</th>
                    <th>Hairdresser Name</th>
                    <th>Appointment Date</th>
                    <th>Time</th>
                    <th>Created Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($appointments as $appointment)
                    <tr>
                        <td><img src="https://i.pinimg.com/736x/18/1e/f2/181ef2b17916a4ac581b47b72295808f.jpg" alt="Profile" style="width: 50px; height: 50px; border-radius: 50%;"></td>
                        <td>{{ $appointment->name }}</td>
                        <td>{{ $appointment->service ? $appointment->service->service_name : 'N/A' }}</td>
                        <td>{{ $appointment->hairdresser ? $appointment->hairdresser->name : 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                        <td>{{ $appointment->created_at }}</td>
                        <td>
                          <!-- Display Icon and Color based on Status -->
                          <form action="{{ route('appointments.updateStatus', $appointment->id) }}" method="POST" style="display: inline;">
                              @csrf
                              @method('PUT')
                              <select name="status" onchange="this.form.submit()" class="form-control" style="width: 120px; display: inline;">
                                  <option value="In Progress" {{ $appointment->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                  <option value="Completed" {{ $appointment->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                  <option value="Cancelled" {{ $appointment->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                              </select>
                          </form>
                          
                          <!-- Status Icon with Color -->
                          <span class="status-icon" style="margin-left: 10px; color: 
                              {{ $appointment->status == 'In Progress' ? 'orange' : 
                              ($appointment->status == 'Completed' ? 'green' : 
                              ($appointment->status == 'Cancelled' ? 'red' : 'gray')) }};">
                              <i class="fas 
                                  {{ $appointment->status == 'In Progress' ? 'fa-spinner' : 
                                  ($appointment->status == 'Completed' ? 'fa-check-circle' : 
                                  ($appointment->status == 'Cancelled' ? 'fa-times-circle' : 'fa-question-circle')) }}"></i>
                          </span>
                      </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center;">No appointments for today.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
<br>
        <!-- Incoming Appointments Section -->
        <h2>Incoming Appointments</h2>
        <table>
            <thead>
                <tr>
                    <th>Profile</th>
                    <th>Name</th>
                    <th>Service Name</th>
                    <th>Hairdresser Name</th>
                    <th>Appointment Date</th>
                    <th>Time</th>
                    <th>Created Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($incoming_appointments as $appointment)
                    <tr>
                        <td><img src="https://i.pinimg.com/736x/18/1e/f2/181ef2b17916a4ac581b47b72295808f.jpg" alt="Profile" style="width: 50px; height: 50px; border-radius: 50%;"></td>
                        <td>{{ $appointment->name }}</td>
                        <td>{{ $appointment->service ? $appointment->service->service_name : 'N/A' }}</td>
                        <td>{{ $appointment->hairdresser ? $appointment->hairdresser->name : 'N/A' }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('F d, Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') }}</td>
                        <td>{{ $appointment->created_at }}</td>
                        <td>
                          <!-- Display Icon and Color based on Status -->
                          <form action="{{ route('appointments.updateStatus', $appointment->id) }}" method="POST" style="display: inline;">
                              @csrf
                              @method('PUT')
                              <select name="status" onchange="this.form.submit()" class="form-control" style="width: 120px; display: inline;">
                                  <option value="In Progress" {{ $appointment->status == 'In Progress' ? 'selected' : '' }}>In Progress</option>
                                  <option value="Completed" {{ $appointment->status == 'Completed' ? 'selected' : '' }}>Completed</option>
                                  <option value="Cancelled" {{ $appointment->status == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                              </select>
                          </form>
                          
                          <!-- Status Icon with Color -->
                          <span class="status-icon" style="margin-left: 10px; color: 
                              {{ $appointment->status == 'In Progress' ? 'orange' : 
                              ($appointment->status == 'Completed' ? 'green' : 
                              ($appointment->status == 'Cancelled' ? 'red' : 'gray')) }};">
                              <i class="fas 
                                  {{ $appointment->status == 'In Progress' ? 'fa-spinner' : 
                                  ($appointment->status == 'Completed' ? 'fa-check-circle' : 
                                  ($appointment->status == 'Cancelled' ? 'fa-times-circle' : 'fa-question-circle')) }}"></i>
                          </span>
                      </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" style="text-align: center;">No incoming appointments.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
