<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use App\Models\Service;
use App\Models\Hairdresser;
use Illuminate\Http\Request;

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
        
        Appointment::create($request->post());
 
        return redirect()->route('appointment.index')->with('success','appointment has been created successfully.');
    }

    public function showCalendar()
{
    $appointments = Appointment::all(); // Assuming you have an Appointment model
    return view('appointment.calendar', compact('appointments'));
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
        $appointment = Appointment::findOrFail($id);
        return view('appointment.edit',compact('appointment'));
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
 
        return redirect()->route('appointment.index')->with('success','appointment Has Been updated successfully');
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
        return redirect()->route('appointment.index')->with('success','appointment has been deleted successfully');
    }

}

