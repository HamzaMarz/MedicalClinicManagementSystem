<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model{

    protected $fillable = [
        'patient_insurance_id',
        'invoice_id',
        'service_description',
        'claim_amount',
        'status',
    ];


    public function patientInsurance(){
        return $this->belongsTo(PatientInsurance::class);
    }


    public function invoice(){
        return $this->belongsTo(PatientInvoice::class);
    }
}
