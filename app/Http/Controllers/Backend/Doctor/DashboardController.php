<?php

namespace App\Http\Controllers\Backend\Doctor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller{
    
    public function doctorDashboard(){
        $doctor = Auth::user();
        return view('Backend.doctors.dashboard' , compact('doctor'));
    }
}
