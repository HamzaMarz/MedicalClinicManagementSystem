<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medication extends Model{

    protected $fillable = [
        'pharmacy_id',
        'name',
        'dosage_form',
        'category',
        'expiry_date',
        'selling_price',
        'description',
    ];

    public function getStatusAttribute(){          // هادا لمتابعة حالة الدواء
        return $this->expiry_date >= now()->toDateString() ? 'Valid' : 'Expired';
    }

    public function pharmacy(){
        return $this->belongsTo(Pharmacy::class);
    }
}
