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

    
    public function edit($id)
    {
        $service = Service::findOrFail($id);
        return view('service.edit',compact('service'));
    }

    
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->update($request->all());
 
        return redirect()->route('service.index')->with('success','Service Has Been updated successfully');

       
    }

    
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('service.index')->with('success','Service has been deleted successfully');
    }

    public function getServicePrice($id)
    {
        $service = Service::find($id); // Fetch the service by ID
        if ($service) {
            return response()->json(['price' => $service->service_category]); // Return the price as JSON
        }
        return response()->json(['error' => 'Service not found'], 404); // Return error if not found
    }

  
}
