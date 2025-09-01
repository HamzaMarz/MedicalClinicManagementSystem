<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicationPharmacy extends Model{

    use SoftDeletes;

    protected $table = 'medication_pharmacy';

    protected $fillable = [
        'pharmacy_id',
        'medication_id',
        'quantity',
    ];


    public function pharmacy(){
        return $this->belongsTo(Pharmacy::class);
    }

    public function medication(){
        return $this->belongsTo(Medication::class)->withTrashed();
    }
}
