<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model{

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'appointment_id',
        'prescribed_at',
        'notes',
    ];
}
