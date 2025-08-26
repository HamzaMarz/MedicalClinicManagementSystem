<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pharmacy;
use Illuminate\Http\Request;

class PharmacyController extends Controller{

    public function pharmacyProfile(){
        $pharmacy = Pharmacy::first();
        return view('Backend.admin.pharmacy.profile' , compact('pharmacy'));
    }





    public function pharmacyView(){
        $pharmacy = Pharmacy::first();
        return view('Backend.admin.pharmacy.view' , compact('pharmacy'));
    }
}
