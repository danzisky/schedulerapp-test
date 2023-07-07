<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Consultant;
use App\Models\Day;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::where('user_id', Auth::user()->id)->get();
        return view('app.appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
       
        $consultants = Consultant::all();
         $user = Auth::user();
        return view('app.appointments.create', compact('consultants', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $appointment = Appointment::create([
            'title' => $request->title,
            'user_id' => Auth::user()->id,
            'description' => $request->description ?? '',
            'consultant_id' => $request->consultant_id,
            'interval_id' => $request->interval_id,
        ])->refresh();

        if($appointment) {
            return view('app.appointments.show', compact('appointment'))->with(['success' => 'appointment created successfully']);
        } else {
            $appointments = Appointment::where('user_id', '=', Auth::user()->id);
            return view('app.appointments.index', compact('appointments'))->with(['error' => 'could not create appointment']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointment $appointment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        //
    }
}
