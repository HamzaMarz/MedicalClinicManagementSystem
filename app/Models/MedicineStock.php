<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicineStock extends Model{

    use SoftDeletes;

    protected $fillable = [
        'medication_id',
        'quantity',
        'remaining_quantity',
        'batch_number',
        'description',
    ];


    public function medication(){
        return $this->belongsTo(Medication::class)->withTrashed();
    }

}
