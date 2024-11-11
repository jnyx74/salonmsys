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
            max-width: 800px;
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
             
            </div>  
    <div id="calendar"></div>

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
    $sql = "SELECT id, name, appointment_date, appointment_time FROM appointments"; // Assuming 'id' is the primary key
    $result = $conn->query($sql);

    $events = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $events[] = array(
                'id' => $row['id'],  // Add the id here
                'title' => $row['name'],
                'start' => $row['appointment_date'] . 'T' . $row['appointment_time'],
                'allDay' => false
            );
        }
    }

    $conn->close();
    ?>

    </div>
</x-app-layout>
<script>
    var events = <?php echo json_encode($events); ?>;

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: events,
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            eventClick: function(info) {
                // Get appointment details
                var appointmentId = info.event.id;
                var appointmentTitle = info.event.title;
                var appointmentTime = info.event.start.toLocaleTimeString();

                // Define action HTML with Laravel-style routes for edit and delete
                var actionHTML = `
                    <div style="text-align: center;">
                        <h3>Appointment: ${appointmentTitle}</h3>
                        <p>Time: ${appointmentTime}</p>
                        <a href="/appointment/edit/${appointmentId}" class="btn btn-primary" style="background-color: #4CAF50; color: white; padding: 10px; margin: 5px;">Edit</a>
                        <form action="/appointment/${appointmentId}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" style="background-color: #f44336; color: white; padding: 10px; margin: 5px;">Delete</button>
                        </form>
                    </div>
                `;

                // Create a modal div to show the popup
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
                modal.style.zIndex = '1000';  // Ensure modal is above other elements
                modal.innerHTML = `
                    <div style="background-color: white; padding: 20px; border-radius: 10px; width: 300px; position: relative;">
                        ${actionHTML}
                        <button onclick="closeModal()" style="padding: 5px 10px; margin-top: 10px;">Close</button>
                    </div>
                `;

                document.body.appendChild(modal);

                // Prevent click events from propagating outside the modal
                modal.addEventListener('click', function(event) {
                    if (event.target === modal) {
                        closeModal();
                    }
                });

                // Close modal function
                window.closeModal = function() {
                    document.body.removeChild(modal);
                };
            }
        });

        calendar.render();
    });
</script>



</body>
</html>
