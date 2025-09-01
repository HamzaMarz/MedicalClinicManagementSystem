<?php

namespace App\Http\Controllers\Backend\Patient;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller{

    public function patientDashboard(){
        $patient = Auth::user();
        return view('Backend.patients.dashboard' , compact('patient'));
    }
}
