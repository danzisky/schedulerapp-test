<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Day extends Model
{
    use HasFactory;

     protected $fillable = [
        'date',
    ];
    public function intervals() {
        return $this->hasMany(Interval::class);
    }

    public function makeIntervals() {
        /* implementation can be done for durations to be passed dynamiaclly */
        $start = '09:00:00';
        $end = '13:00:00';

        $this->intervals()->createMany($this->divideDay($start, $end));
        
        $start = '15:30:00';
        $end = '21:00:00';
        
        $this->divideDay($start, $end);
        $this->intervals()->createMany($this->divideDay($start, $end));

        return $this;
    }

    public function divideDay($start, $end) {
        $date = $this->date;
        $intervals = array();

        $cStart = Carbon::parse("$date $start");
        $cEnd = Carbon::parse("$date $end");
        $cInterval = $cStart;

        while ($cEnd->greaterThan($cInterval)) {
            $intervals[] = [
                'from' => (string) $cInterval->format('H:i:s'),
                'to' => (string) $cInterval->addHour()->format('H:i:s'),
            ];
            $cInterval = $cInterval->addMinutes(30); /* adding wait between sessions */
        };
        
        return $intervals;
    }
}
