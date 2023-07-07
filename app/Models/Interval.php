<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interval extends Model
{
    use HasFactory;

    protected $fillable = ['from', 'to'];

    public function appointment() {
        return $this->hasOne(Appointment::class);
    }
    public function day() {
        return $this->belongsTo(Day::class);
    }
}
