<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model{

    protected $fillable = [
        'blood_type',
        'emergency_contact',
        'allergies',
        'chronic_diseases',
        'user_id',
    ];
}
