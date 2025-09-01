<?php

namespace App\Http\Controllers\Backend\Employee\Receptionist;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller{
    
    public function receptionistDashboard(){
        $receptionist = Auth::user();
        return view('Backend.employees.receptionists.dashboard' , compact('receptionist'));
    }
}
