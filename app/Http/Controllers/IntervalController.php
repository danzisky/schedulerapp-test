<?php

namespace App\Http\Controllers;

use App\Models\Consultant;
use App\Models\Day;
use App\Models\Interval;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class IntervalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function intervals(Request $request, Consultant $consultant)
    {   $date = $request->date;
        $cdate = Carbon::parse($date);
        if(!$cdate->isWeekday()) {
            abort(400, "Error. $cdate->englishDayOfWeek, is not a weekday");
        }
        $day = Day::firstOrCreate([
            'date' => $request->date,
         ], []);
        $intervals = $day->intervals;
        if(count($intervals) < 1) {
            $intervals = $day->makeIntervals()->intervals;
        };
        $consultantBookedIntervals = $consultant->appointments()->whereIn('interval_id', $day->intervals->pluck('id'))->pluck('interval_id');
        $intervals = $day->intervals()->whereNotIn('id', $consultantBookedIntervals)->get();

        return $intervals; 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Interval $interval)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Interval $interval)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Interval $interval)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Interval $interval)
    {
        //
    }
}
