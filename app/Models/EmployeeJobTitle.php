<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeJobTitle extends Model{

    protected $fillable = [
        'employee_id',
        'job_title_id',
    ];
}
