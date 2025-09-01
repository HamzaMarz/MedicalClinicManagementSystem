<?php

namespace App\Http\Controllers\Backend\Employee\StoreSupervisor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller{

    public function storeSupervisorDashboard(){
        return view('Backend.employees.store_supervisors.dashboard');
    }
}
