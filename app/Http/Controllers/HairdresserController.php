<?php

namespace App\Http\Controllers;
use App\Models\Hairdresser;
use Illuminate\Http\Request;

class HairdresserController extends Controller
{
    public function index()
    {
        $hairdressers = Hairdresser::orderBy('id','asc')->paginate(10);
        return view('hairdresser.index', compact('hairdressers'));
    }
 
    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('hairdresser.create');
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
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'position' => 'required',
            'job_description' => 'required'
        ]);
        
        Hairdresser::create($request->post());
 
        return redirect()->route('hairdresser.index')->with('success','Hairdresser has been created successfully.');
    }
 
    /**
    * Display the specified resource.
    *
    * @param  \App\Hairdresser  $Hairdresser
    * @return \Illuminate\Http\Response
    */
    public function show(Hairdresser $hairdresser)
    {
        return view('show',compact('hairdresser'));
    }
 
    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Models\Hairdresser $Hairdresser
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $hairdresser = Hairdresser::findOrFail($id);
        return view('hairdresser.edit',compact('hairdresser'));
    }
 
    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Models\Hairdresser  $Hairdresser
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request,$id)
    {
        $hairdresser = Hairdresser::findOrFail($id);
        $hairdresser->update($request->all());
 
        return redirect()->route('hairdresser.index')->with('success','Hairdresser Has Been updated successfully');
    }
 
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Models\Hairdresser $Hairdresser
    * @return \Illuminate\Http\Response
    */
    public function destroy(Hairdresser $hairdresser)
    {
        $hairdresser->delete();
        return redirect()->route('hairdresser.index')->with('success','Hairdresser has been deleted successfully');
    }

}

