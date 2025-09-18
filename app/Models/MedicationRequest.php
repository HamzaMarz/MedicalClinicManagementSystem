<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicationRequest extends Model{

    protected $fillable = [
        'medication_id',
        'admin_id',
        'supervisor_id',
        'requested_quantity',
        'request_type',
        'unit_type',
        'status',
        'note'
    ];

    public function medication(){
        return $this->belongsTo(Medication::class)->withTrashed();
    }

    public function admin(){
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function supervisor(){
        return $this->belongsTo(User::class, 'supervisor_id');
    }
}
