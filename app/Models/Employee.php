<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model{
    protected $fillable = [
        'user_id',
        'department_id',
        'work_start_time',
        'work_end_time',
        'working_days',
        'hire_date',
        'status',
        'short_biography',
    ];

    protected $casts = [
        'working_days' => 'array',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function department(){
        return $this->belongsTo(Department::class);
    }

    public function jobTitles(){
        return $this->belongsToMany(JobTitle::class, 'employee_job_titles');
    }

    public function doctor(){
        return $this->hasOne(Doctor::class);
    }
}
