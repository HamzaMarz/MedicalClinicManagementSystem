<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model{
    protected $fillable = [
        'employee_id',
        'qualification',
        'experience_years',
    ];


    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id');
    }

    public function user(){
        return $this->hasOneThrough(
            User::class,
            Employee::class,
            'id',         // Employee.id
            'id',         // User.id
            'employee_id',// Doctor.employee_id
            'user_id'     // Employee.user_id
        );
    }

}
