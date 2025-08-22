<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClinicInfo extends Model{

    protected $table = 'clinic_info';

    protected $fillable = [
        'name', 'email', 'phone', 'location',
        'work_start', 'work_end', 'work_days', 'description'
    ];

    protected $casts = [
        'work_days' => 'array',
    ];
}
