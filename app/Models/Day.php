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
        $start = '09:00:00';
        $end = '13:00:00';

        $this->divideDay($start, $end);

        $start = '15:30:00';
        $end = '21:00:00';

        $this->divideDay($start, $end);
    }

    public function divideDay($start, $end) {
        $date = $this->date;
        $intervals = array();

        $cStart = Carbon::parse("$date $start");
        $cEnd = Carbon::parse("$date $end");
        dump((string) $cStart, (string) $cEnd);
        $cInterval = $cStart;

        while ($cEnd->greaterThan($cInterval)) {
            $intervals[] = [
                'from' => (string) $cInterval,
                'to' => (string) $cInterval->addHour(),
            ];
            $cInterval = $cInterval->addMinutes(30);
        };
        dump($intervals);
    }
}
