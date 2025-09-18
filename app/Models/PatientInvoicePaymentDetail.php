<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientInvoicePaymentDetail extends Model{

    protected $fillable = [
        'payment_id',
        'amount_paid',
        'payment_method',
        'payment_date',
        'notes',
    ];


    public function payment(){
        return $this->belongsTo(PatientInvoicePayment::class);
    }
}
