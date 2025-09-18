<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientInsurance extends Model{

    protected $fillable = [
        'patient_id',
        'provider_id',
        'insurance_number',
        'start_date',
        'end_date',
        'coverage_percentage',
    ];

    public function patient(){
        return $this->belongsTo(Patient::class);
    }


    public function provider(){
        return $this->belongsTo(InsuranceProvider::class);
    }
}
