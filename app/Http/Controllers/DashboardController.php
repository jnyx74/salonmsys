<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Hairdresser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Initialize variables
        $total_service = 0;
        $total_appointment = 0;
        $total_incoming_appointments = 0;
        $total_hairdresser = 0;
        $total_cancelled = 0;

        // Get current date
        $today = now()->toDateString();

        // Get totals for service, hairdresser, and cancelled appointments
        $total_service = Service::count();
        $total_hairdresser = Hairdresser::count();
        $total_cancelled = Appointment::where('status', 'cancelled')->count();

        // Get the authenticated user
        $user = auth()->user();

        // Check if the user is an admin or hairdresser
        if ($user->role === 'admin' || $user->role === 'hairdresser') {
            // Admin and hairdresser can see all appointments
            $appointments = Appointment::whereDate('appointment_date', $today)->get();
            $incoming_appointments = Appointment::whereDate('appointment_date', '>', $today)->get();

            $total_appointment = $appointments->count();
            $total_incoming_appointments = $incoming_appointments->count();
        } else {
            // Customers can only see their own appointments
            $appointments = Appointment::where('user_id', $user->id)
                ->whereDate('appointment_date', $today)
                ->get();

            $incoming_appointments = Appointment::where('user_id', $user->id)
                ->whereDate('appointment_date', '>', $today)
                ->get();

            $total_appointment = $appointments->count();
            $total_incoming_appointments = $incoming_appointments->count();
        }

        // Return the view with the data
        return view('dashboard', compact(
            "total_service",
            "total_appointment",
            "total_incoming_appointments",
            "total_cancelled",
            "total_hairdresser",
            "appointments",
            "incoming_appointments"
        ));
    }
}