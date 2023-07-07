<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $guarded = [];
    public function interval() {
        return $this->belongsTo(Interval::class);
    }
    public function consultant() {
        return $this->belongsTo(Consultant::class);
    }
}
