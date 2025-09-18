<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InsuranceProvider extends Model{

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'representative_name',
        'representative_phone',
        'status',
    ];
}
