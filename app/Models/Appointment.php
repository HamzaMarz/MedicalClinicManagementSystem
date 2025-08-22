<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model{

    protected $fillable = [
        'doctor_id',
        'patient_id',
        'department_id',
        'date',
        'time',
        'status',
        'notes',
    ];
}
