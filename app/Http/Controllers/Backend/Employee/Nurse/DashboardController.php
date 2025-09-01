<?php

namespace App\Http\Controllers\Backend\Employee\Nurse;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller{
    
    public function nurseDashboard(){
        $nurse = Auth::user();
        return view('Backend.employees.nurses.dashboard' , compact('nurse'));
    }
}
