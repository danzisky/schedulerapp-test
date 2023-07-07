<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    public function interval() {
        return $this->hasOne(Interval::class);
    }
    public function consultant() {
        return $this->hasOne(Consultant::class);
    }
}
