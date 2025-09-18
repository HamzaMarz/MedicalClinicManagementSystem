<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\PatientInvoicePaymentDetail;

class PatientInvoicePayment extends Model{

    protected $fillable = [
        'invoice_id',
    ];


    public function invoice(){
        return $this->belongsTo(PatientInvoice::class);
    }

    public function patientInvoicePaymentDetails(){
        return $this->hasMany(PatientInvoicePaymentDetail::class, 'payment_id');
    }
}
