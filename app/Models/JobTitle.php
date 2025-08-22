<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobTitle extends Model{

    protected $fillable = [
        'name',
    ];


    public function employees(){
        return $this->belongsToMany(Employee::class, 'employee_job_titles');
    }

}
