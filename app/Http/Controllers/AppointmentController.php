<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Consultant;
use App\Models\Day;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = Appointment::all();
        return view('app.appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $request->replace([
            'date' => date('Y-m-d'),
        ]);
        $day = Day::firstOrCreate([
            'date' => $request->date,
         ], []);
         
         $consultants = Consultant::all();
        $intervals = $day->intervals;
        if(count($intervals) < 1) {
            $intervals = $day->makeIntervals()->$intervals;
        };
        return view('app.appointments.create', compact('intervals', 'consultants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $appointment = Appointment::create([
            'title' => $request->title,
            'description' => $request->description ?? '',
            'consultant_id' => $request->consultant_id,
            'interval_id' => $request->interval_id,
        ]);
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
