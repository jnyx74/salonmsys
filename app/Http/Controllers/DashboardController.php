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
    public function index(){
        $total_service = 0;
        $total_appointment = 0;
        $total_incoming_appointments = 0;
        $total_hairdresser = 0;
        $total_cancelled =0;
        $result = 0;
        // Get current date
        $today = now()->toDateString();

        $total_service = Service::count();
        $total_appointment = Appointment::whereDate('appointment_date', $today)->count();
        $total_incoming_appointments = Appointment::whereDate('appointment_date', '>', $today)->count();
        $total_cancelled = Appointment::where('status', "cancelled")->count();
        $total_hairdresser = Hairdresser::count();
        // Fetch current date's appointments
        $appointments = Appointment::whereDate('appointment_date', $today)->get();
        $incoming_appointments = Appointment::whereDate('appointment_date', '>', $today)->get();
        return view('dashboard',compact("total_service","total_appointment","total_incoming_appointments","total_cancelled","total_hairdresser","appointments","incoming_appointments"));
    }

    
}
