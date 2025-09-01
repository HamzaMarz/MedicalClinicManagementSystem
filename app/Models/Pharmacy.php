<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model{

    protected $fillable = [
        'name',
        'location',
        'phone',
        'email',
        'manager_name',
        'work_start_time',
        'work_end_time',
        'working_days',
        'description',
    ];

    protected $casts = [
        'working_days' => 'array',
    ];


    public function medications(){
        return $this->belongsToMany(Medication::class, 'medication_pharmacy')->withPivot('quantity')->withTimestamps();
    }
}
