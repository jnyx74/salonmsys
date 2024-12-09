<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Hairdresser;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::orderBy('id','asc')->paginate(10);

        return view('appointment.index', compact('appointments'));
    }
 
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        // Fetch services from the service table
        $services = Service::all(); 
        // Fetch services from the hairdresser table
        $hairdressers = Hairdresser::all(); 

        // Pass services to the view
        return view('appointment.create', compact('services','hairdressers'));
   
    }
 
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
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
                        ->exists();
                    if ($exists) {
                        $fail('This hairdresser is already booked for the selected date.');
                    }
                },
            ],
            'appointment_date' => ['required', 'date', 'after_or_equal:tomorrow'],
            'appointment_time' => 'required|date_format:H:i',
        ]);
    
        Appointment::create($request->post());
 
        return redirect()->route('appointment.calendar')->with('success','appointment has been created successfully.');
    }

    public function showCalendar($id = null)
{
    $appointments = Appointment::all(); // Assuming you have an Appointment model
     // Fetch services from the service table
     $services = Service::all(); 
     // Fetch services from the hairdresser table
     $hairdressers = Hairdresser::all(); 

     // Pass services to the view
    return view('appointment.calendar', compact('appointments','services','hairdressers'));
}

 
    /**
    * Display the specified resource.
    *
    * @param  \App\appointment  $appointment
    * @return \Illuminate\Http\Response
    */
    public function show(Appointment $appointment)
    {
        return view('show',compact('appointment'));
    }
 
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\appointment $appointment
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        // Fetch services from the service table
        $services = Service::all(); 
        // Fetch services from the hairdresser table
        $hairdressers = Hairdresser::all(); 

        $appointment = Appointment::findOrFail($id);
        return view('appointment.edit',compact('appointment','services','hairdressers'));
    }
 
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\appointment  $appointment
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request,$id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->all());
 
        return redirect()->route('appointment.calendar')->with('success','appointment Has Been updated successfully');
    }
 
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\appointment $appointment
    * @return \Illuminate\Http\Response
    */
    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointment.calendar')->with('success','appointment has been deleted successfully');
    }


    public function getServicePrice($id)
{
    $service = Service::find($id);
    if ($service) {
        return response()->json(['price' => $service->service_category]);
    } else {
        return response()->json(['price' => null]);
    }
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
    $appointment->status = $request->status;
    $appointment->save();

    return redirect()->route('dashboard')->with('success', 'Appointment status updated successfully!');
}

}

