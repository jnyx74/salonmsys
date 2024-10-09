<?php

namespace App\Http\Controllers;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        // Retrieve all services from the database
        $services = Service::paginate(10); // 10 items per page
    return view('service.index', compact('services'));
    }
   
    public function create()
    {
        return view('service.create');
    }

    
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'service_name' => 'required|string|max:255',
            'service_detail' => 'required|string',
            'service_category' => 'required|string|max:255',
        ]);

        // Store the validated data in the database
        Service::create([
            'service_name' => $request->input('service_name'),
            'service_detail' => $request->input('service_detail'),
            'service_category' => $request->input('service_category'),
        ]);

        // Redirect to the index page with a success message
        return redirect()->route('service.index')->with('success', 'Service has been created successfully.');
    }

    
    public function show(Service $service)
    {
        return view('service.show',compact('service'));
    }

    
    public function edit(Service $service)
    {
        return view('service.edit',compact('s
        ervice'));
    }

    
    public function update(Request $request, Service $service)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        
        $Service->fill($request->post())->save();

        return redirect()->route('service.index')->with('success','Service Has Been updated successfully');
    }

    
    public function destroy(Service $service)
    {
        $Service->delete();
        return redirect()->route('service.index')->with('success','Service has been deleted successfully');
    }
}
