<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\Hairdresser;
use App\Models\User;
use DateTime;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\CreatedNotication;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('service') // Eager load service
            ->orderBy('id', 'asc')
            ->paginate(100); // Adjust pagination size as needed

        return view('appointment.index', compact('appointments'));
    }

    public function create()
    {
        $services = Service::all();
        $hairdressers = Hairdresser::all();

        // Get available times for the selected hairdresser and date if available
        $validTimes = [];

        if (request()->has('hairdresser_id') && request()->has('appointment_date')) {
            $hairdresserId = request('hairdresser_id');
            $appointmentDate = request('appointment_date');
            $bookedTimes = $this->getBookedTimes($appointmentDate, $hairdresserId);
            $validTimes = $this->generateValidTimes($bookedTimes);
        }

        return view('appointment.create', compact('services', 'hairdressers', 'validTimes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'hairdresser_id' => [
                'required',
                Rule::exists('hairdressers', 'id'),
                function ($attribute, $value, $fail) use ($request) {
                    $exists = DB::table('appointments')
                        ->where('hairdresser_id', $value)
                        ->where('appointment_date', $request->appointment_date)
                        ->where('appointment_time', $request->appointment_time)
                        ->exists();
                    if ($exists) {
                        $fail('This hairdresser is already booked for the selected date and time.');
                    }
                },
            ],
            'status' => ['required', Rule::in(['In Progress', 'Completed', 'Cancelled'])],
            'appointment_date' => ['required', 'date', 'after_or_equal:today'],
            'appointment_time' => [
                'required',
                'date_format:H:i',
                Rule::in($this->generateValidTimes()),
            ],
        ]);
        $hasIncompleteAppointments = Appointment::where('user_id', auth()->id())
        ->whereNotIn('status', ['Completed', 'Cancelled'])
        ->exists();

    if ($hasIncompleteAppointments) {
        session()->flash('error', 'You cannot book a new appointment as you have an incomplete appointment.');
        return redirect()->back()->withInput();
    }

    $existingAppointment = Appointment::where('user_id', auth()->id())
        ->where('appointment_date', $request->appointment_date)
        ->where(function ($query) {
            $query->whereNotIn('status', ['Completed', 'Cancelled']);
        })
        ->exists();

    if ($existingAppointment) {
        session()->flash('error', 'You cannot book a new appointment as you already have an incomplete appointment.');
        return redirect()->back()->withInput();
    }
        $request->merge(['user_id' => auth()->id()]);
        $appointment = Appointment::create($request->post());
    
        // Send email notification
        auth()->user()->notify(new CreatedNotication($appointment));
    
        session()->flash('success', 'Appointment has been created successfully.');
        return redirect()->route('appointment.calendar');
    }

    public function showCalendar()
    {
        $userId = auth()->id(); // Get the logged-in user's ID

        // Filter appointments by the logged-in user
        $appointments = Appointment::with(['service', 'hairdresser'])
            ->where('user_id', $userId)
            ->get();

        // Get all services and hairdressers for the logged-in user (if needed)
        $services = Service::all(); // Or filter based on user preferences if needed
        $hairdressers = Hairdresser::all(); // Or filter based on user preferences if needed

        // Generate valid appointment times
        $validTimes = $this->generateValidTimes();

        return view('appointment.calendar', compact('appointments', 'services', 'hairdressers', 'validTimes'));
    }

    public function show(Appointment $appointment)
    {
        return view('appointment.show', compact('appointment'));
    }

    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $services = Service::all();
        $hairdressers = Hairdresser::all();

        // Fetch booked times for the selected date and hairdresser
        $bookedTimes = $this->getBookedTimes($appointment->appointment_date, $appointment->hairdresser_id);

        // Generate valid times excluding booked ones
        $validTimes = $this->generateValidTimes($bookedTimes);

        return view('appointment.edit', compact('appointment', 'services', 'hairdressers', 'validTimes'));
    }
            
    
    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $request->validate([
            'status' => ['required', Rule::in(['In Progress', 'Confirmed', 'Completed', 'Cancelled'])],
        ]);

        $appointment->update($request->all());

        return redirect()->route('appointment.calendar')->with('success', 'Appointment has been updated successfully.');
    }


   

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointment.calendar')->with('success', 'Appointment has been deleted successfully.');
    }

    public function getServicePrice($id)
    {
        $service = Service::find($id);
        return response()->json(['price' => $service->service_category]);
    }

    public function checkAvailability(Request $request)
    {
        $available = !DB::table('appointments')
            ->where('hairdresser_id', $request->hairdresser_id)
            ->where('appointment_date', $request->appointment_date)
            ->exists();

        return response()->json(['available' => $available]);
    }

    public function updateStatus(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        // Check if the status is 'completed'
        if ($appointment->status === 'Completed') {
            return redirect()->route('dashboard')->with('error', 'Completed appointments cannot be edited.');
        }

        $request->validate([
            'status' => ['required', Rule::in(['In Progress', 'Completed', 'Cancelled'])],
        ]);

        $appointment->status = $request->status;
        $appointment->save();

        return redirect()->route('dashboard')->with('success', 'Appointment status updated successfully!');
    }
    public function getAvailableTimes(Request $request)
    {
        $hairdresserId = $request->hairdresser_id;
        $appointmentDate = $request->appointment_date;
        $bookedTimes = $this->getBookedTimes($appointmentDate, $hairdresserId);
        $validTimes = $this->generateValidTimes($bookedTimes);
    
        return response()->json(['validTimes' => $validTimes]);
    }
    private function getBookedTimes($appointmentDate, $hairdresserId = null)
        {
            $query = Appointment::where('appointment_date', $appointmentDate);

            if ($hairdresserId) {
                $query->where('hairdresser_id', $hairdresserId);
            }

            return $query->pluck('appointment_time')->toArray(); // Returns an array of booked times
        }
        
        private function generateValidTimes($bookedTimes = [])
        {
            $times = [];
            $start = new DateTime('08:00');
            $end = new DateTime('21:00');
    
            while ($start <= $end) {
                $time = $start->format('H:i');
                // Only include times that are not in the $bookedTimes array
                if (!in_array($time, $bookedTimes)) {
                    $times[] = $time;
                }
                $start->modify('+30 minutes');
            }
    
            return $times;
        }

   
    public function report(Request $request) 
    {
        // Default date range: current month
        $startDate = $request->input('start_date', now()->startOfMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->endOfMonth()->format('Y-m-d'));

        // Calculate total price for completed appointments within the selected date range
        $totalPrice = DB::table('appointments')
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->where('appointments.status', 'completed')
            ->whereBetween('appointments.appointment_date', [$startDate, $endDate])
            ->sum('services.service_category');

        // Count total records (completed appointments) for the selected date range
        $totalRecords = DB::table('appointments')
            ->where('status', 'completed')
            ->whereBetween('appointment_date', [$startDate, $endDate])
            ->count();

        // Generate chart data: Monthly breakdown within the selected range
        $chartLabels = [];
        $chartData = [];

        // Get data grouped by month for completed appointments
        $monthlyData = DB::table('appointments')
            ->join('services', 'appointments.service_id', '=', 'services.id')
            ->selectRaw('MONTH(appointments.appointment_date) as month, SUM(services.service_category) as total')
            ->where('appointments.status', 'completed')
            ->whereBetween('appointments.appointment_date', [$startDate, $endDate])
            ->groupByRaw('MONTH(appointments.appointment_date)')
            ->orderByRaw('MONTH(appointments.appointment_date)')
            ->get();

        // Fill labels and data
        foreach ($monthlyData as $data) {
            $chartLabels[] = \DateTime::createFromFormat('!m', $data->month)->format('F'); // Get month name
            $chartData[] = $data->total;
        }

        // Pass data to the view
        return view('appointment.report', compact('chartLabels', 'chartData', 'totalPrice', 'totalRecords', 'startDate', 'endDate'));
    }
    
}
