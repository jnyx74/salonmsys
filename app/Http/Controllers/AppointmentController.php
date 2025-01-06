<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Service;
use App\Models\Hairdresser;
use DateTime;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with('service') // Eager load service
            ->orderBy('id', 'asc')
            ->paginate(10); // Adjust pagination size as needed

        return view('appointment.index', compact('appointments'));
    }

    public function create()
    {
        $services = Service::all();
        $hairdressers = Hairdresser::all();

        return view('appointment.create', compact('services', 'hairdressers'));
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
            'appointment_date' => ['required', 'date', 'after_or_equal:today'],
            'appointment_time' => 'required|date_format:H:i',
        ]);

        $existingAppointment = Appointment::where('user_id', auth()->id())
            ->where('appointment_date', $request->appointment_date)
            ->whereNotIn('status', ['Completed', 'Canceled'])
            ->exists();

        if ($existingAppointment) {
            return redirect()->back()->withErrors([
                'appointment_date' => 'You have already booked an appointment on this date.',
            ])->withInput();
        }

        $request->merge(['user_id' => auth()->id()]);
        Appointment::create($request->post());

        return redirect()->route('appointment.calendar')->with('success', 'Appointment has been created successfully.');
    }

    public function showCalendar()
    {
        $appointments = Appointment::with(['service', 'hairdresser'])->get();
        $services = Service::all();
        $hairdressers = Hairdresser::all();

        return view('appointment.calendar', compact('appointments', 'services', 'hairdressers'));
    }

    public function show(Appointment $appointment)
    {
        return view('appointment.show', compact('appointment'));
    }

    public function edit($id)
    {
        $services = Service::all();
        $hairdressers = Hairdresser::all();
        $appointment = Appointment::findOrFail($id);

        return view('appointment.edit', compact('appointment', 'services', 'hairdressers'));
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $request->validate([
            'status' => ['required', Rule::in(['Pending', 'Confirmed', 'Completed', 'Canceled'])],
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
