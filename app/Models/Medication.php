<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model{

    protected $fillable = [
        'name',
        'dosage_form_id',
        'strength',
        'image',
        'description',
        'purchase_price',
        'selling_price',
    ];
}
