<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PatientInvoice extends Model{

    protected $fillable = [
        'appointment_id',
        'total_amount',
        'discount',
        'final_amount',
        'status',
        'payment_method',
        'notes',
    ];


    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }


    public function items(){
        return $this->hasMany(PatientInvoiceItem::class, 'invoice_id');
    }

    
    public function payments(){
        return $this->hasMany(PatientInvoicePayment::class, 'invoice_id');
    }
}
