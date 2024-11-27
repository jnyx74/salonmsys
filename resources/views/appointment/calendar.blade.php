<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Calendar</title>
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
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
            max-width: 1000px;
            margin: 10px auto;
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
        .appointment-buttons {
            display: flex;
            justify-content: center;
            padding: 5px;
            background-color: #fff;
        }

        .appointment-buttons .btn {
            background-color: green;
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

        @media (max-width: 768px) {
            .container {
                width: 90%;
            }
        }
        /* Modal Container */
    .modal {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1000;
        animation: fadeIn 0.3s ease-in-out;
    }

    /* Modal Content */
    .modal-content {
        background: white;
        width: 90%;
        max-width: 500px;
        border-radius: 10px;
        padding: 20px 30px;
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        position: relative;
        animation: slideIn 0.4s ease-in-out;
    }

    /* Modal Header */
    .modal-content h3 {
        font-size: 1.5rem;
        color: #333;
        margin-bottom: 15px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 10px;
    }

    /* Appointment Details */
    .modal-content p {
        font-size: 1rem;
        margin: 10px 0;
        color: #555;
    }

    .modal-content p strong {
        color: #333;
    }

    /* Action Buttons */
    .modal-actions {
        margin-top: 20px;
        display: flex;
        justify-content: space-between;
        gap: 10px;
    }

    .modal-actions a, .modal-actions button {
        flex: 1;
        padding: 10px 15px;
        font-size: 1rem;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        transition: background-color 0.3s ease, transform 0.2s;
    }

    .modal-actions a {
        background-color: #007BFF;
        color: white;
    }

    .modal-actions a:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .modal-actions button {
        background-color: #DC3545;
        color: white;
    }

    .modal-actions button:hover {
        background-color: #a71d2a;
        transform: scale(1.05);
    }

    .modal-content button.close-modal {
        position: absolute;
        top: 10px;
        right: 10px;
        background: none;
        border: none;
        font-size: 1.5rem;
        color: #aaa;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .modal-content button.close-modal:hover {
        color: #333;
    }

    /* Animations */
    @keyframes fadeIn {
        from {
            background-color: rgba(0, 0, 0, 0);
        }
        to {
            background-color: rgba(0, 0, 0, 0.5);
        }
    }

    @keyframes slideIn {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }
        </style>
<body>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(' Appointment Calendar') }}
        </h2>
    </x-slot>
    <div class="container">
      <!-- appointment Buttons -->
      <div class="appointment-buttons">
                <a href="{{ route('appointment.create') }}" class="btn">New Appointment</a>
             
            </div>  <div id="calendar"></div>

    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "salonsysdb";

    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch appointments
    $sql = "SELECT id, name, appointment_date, appointment_time FROM appointments";
    $result = $conn->query($sql);

    $events = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $events[] = [
                'id' => $row['id'],
                'title' => $row['name'],
                'start' => $row['appointment_date'] . 'T' . $row['appointment_time'],
                'allDay' => false
            ];
        }
    }
    $conn->close();
    ?>
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var events = <?php echo json_encode($events); ?>;
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: events,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            dateClick: function (info) {
                // Modal for creating new appointment
               // Get today's date and set time to midnight
    const today = new Date();
    today.setHours(0, 0, 0, 0);

    // Get the clicked date
    const clickedDate = new Date(info.dateStr);
    
    // Calculate the time difference in days
    const timeDiff = clickedDate - today;
    const daysDiff = timeDiff / (1000 * 60 * 60 * 24);

    if (daysDiff < 1) {
        alert("Appointments must be booked at least 1 day in advance.");
        return; // Stop further execution
    }

    // Rest of the modal creation logic
    var modal = document.createElement('div');
    modal.style.position = 'fixed';
    modal.style.top = '0';
    modal.style.left = '0';
    modal.style.width = '100%';
    modal.style.height = '100%';
    modal.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
    modal.style.display = 'flex';
    modal.style.justifyContent = 'center';
    modal.style.alignItems = 'center';
    modal.style.zIndex = '1000';

    modal.innerHTML = `
        <div style="background-color: white; padding: 20px; border-radius: 10px; width: 400px; position: relative;">
            <h2>Create New Appointment</h2>
            <form action="/appointment/store" method="POST">
                @csrf
                <label>Name:</label>
                <input type="text" name="name" required style="width: 100%; margin-bottom: 10px; padding: 5px;">
                <label>Phone:</label>
                <input type="text" name="phone" required  style="width: 100%; margin-bottom: 10px; padding: 5px;">
                            <div class="form-group">
                                <label for="status">Status</label>
                                <input type="time" name="status" id="status" class="status" style="width:100%">
                                @error('status')<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group">
                                <label for="service_id">Service Name</label>
                                <select name="service_id" id="service_id" class="form-control" style="width:100%">
                                    <option value="" disabled selected>Select a service</option>
                                    @foreach($services as $service)
                                        <option value="{{ $service->id }}">{{ $service->service_name }}</option>
                                    @endforeach
                                </select>
                                @error('service_id')<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="form-group">
                                <label for="hairdresser_id">Hairdresser Name</label>
                                <select name="hairdresser_id" id="hairdresser_id" class="form-control" style="width:100%">
                                    <option value="" disabled selected>Select a hairdresser</option>
                                    @foreach($hairdressers as $hairdresser)
                                        <option value="{{ $hairdresser->id }}">{{ $hairdresser->name }}</option>
                                    @endforeach
                                </select>
                                @error('hairdresser_id')<div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>@enderror
                            </div><label>Appointment Date:</label>
                            <input type="date" name="appointment_date" value="${info.dateStr}" readonly>
                            <label>Appointment Time:</label>
                            <input type="time" name="appointment_time" required>
                            <button type="submit" class="btn" style="width: 100%; background-color: #4CAF50; color: white;">Save</button>
                        </form>
                        <button onclick="closeModal()" style="padding: 5px 10px; margin-top: 10px; width: 100%;">Cancel</button>
                    </div>
                `;

                document.body.appendChild(modal);

                window.closeModal = function () {
                    document.body.removeChild(modal);
                };

                modal.addEventListener('click', function (event) {
                    if (event.target === modal) closeModal();
                });
            },
            eventClick: function (info) {
                // Modal for viewing, editing, or deleting an appointment
                var appointmentId = info.event.id;
                var appointmentTitle = info.event.title;
                var appointmentDate = info.event.start.toISOString().split('T')[0];
                var appointmentTime = info.event.start.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

                var modal = document.createElement('div');
                modal.style.position = 'fixed';
                modal.style.top = '0';
                modal.style.left = '0';
                modal.style.width = '100%';
                modal.style.height = '100%';
                modal.style.backgroundColor = 'rgba(0, 0, 0, 0.5)';
                modal.style.display = 'flex';
                modal.style.justifyContent = 'center';
                modal.style.alignItems = 'center';
                modal.style.zIndex = '1000';

                modal.innerHTML = `
                    <div class="modal-content">
                        <button class="close-modal" onclick="closeModal()">×</button>
                        <h3>Appointment Details</h3>
                        <p><strong>Title:</strong> ${appointmentTitle}</p>
                        <p><strong>Date:</strong> ${appointmentDate}</p>
                        <p><strong>Time:</strong> ${appointmentTime}</p>
                        <div class="modal-actions">
                            <a href="/appointment/edit/${appointmentId}">Edit</a>
                            <form action="/appointment/${appointmentId}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </div>
                    </div>
                `;

                document.body.appendChild(modal);

                window.closeModal = function () {
                    document.body.removeChild(modal);
                };

                modal.addEventListener('click', function (event) {
                    if (event.target === modal) closeModal();
                });
            }
        });

        calendar.render();
    });
</script>
</body>
</html>
