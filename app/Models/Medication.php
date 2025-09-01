<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\MedicationExpiredNotification;

class Medication extends Model{

    use SoftDeletes;

    protected $fillable = [
        'name',
        'dosage_form',
        'category',
        'expiry_date',
        'selling_price',
        'description',
    ];

    public function getStatusAttribute(){
        if ($this->expiry_date < now()->toDateString()) {
            // تحقق إذا فيه إشعار موجود لنفس الدواء
            $exists = DB::table('notifications')
                ->where('notifiable_id', 1) // ممكن تغيرها للدكتور/المسؤول
                ->where('type', \App\Notifications\MedicationExpiredNotification::class)
                ->where('data->medication_id', $this->id) // يفحص بالـ JSON داخل data
                ->exists();

            if (! $exists) {
                $user = User::role('admin')->first();
                Notification::send($user, new MedicationExpiredNotification($this));
            }

            return 'Expired';
        }

        return 'Valid';
    }

    public function stocks(){
        return $this->hasMany(MedicineStock::class);
    }

    public function pharmacies(){
        return $this->belongsToMany(Pharmacy::class, 'medication_pharmacy')->withPivot('quantity')->withTimestamps();
    }
}
