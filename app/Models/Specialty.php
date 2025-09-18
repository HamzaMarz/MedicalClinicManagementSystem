<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model{

    protected $fillable = [
        'name',
        'description',
    ];

    public function departments(){
        return $this->belongsToMany(Department::class, 'department_specialty', 'specialty_id', 'department_id');
    }
}
