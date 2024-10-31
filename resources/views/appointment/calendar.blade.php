<!DOCTYPE html>
<html>
<head>
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.5/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.5/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.5/main.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@6.1.5/main.min.js"></script>
</head>
<body>
    <div id="calendar"></div>

    <!-- Place the script here, after the HTML -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            if (calendarEl) { // Check if the element exists
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    selectable: true,
                    events: [
                        @foreach($appointments as $appointment)
                        {
                            title: '{{ $appointment->name }}',
                            start: '{{ $appointment->appointment_date }}T{{ $appointment->appointment_time }}',
                            extendedProps: {
                                phone: '{{ $appointment->phone }}',
                                created_at: '{{ $appointment->created_at }}',
                                status: '{{ $appointment->status }}'
                            }
                        },
                        @endforeach
                    ],
                    eventClick: function(info) {
                        alert(`Customer: ${info.event.title}
                    Phone: ${info.event.extendedProps.phone}
                    Appointment Time: ${info.event.start.toISOString().slice(0, 19).replace('T', ' ')}
                    Status: ${info.event.extendedProps.status}`);
                    }
                });
                calendar.render();
            }
        });
    </script>
</body>
</html>
