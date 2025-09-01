<?php

namespace App\Http\Controllers\Backend\Employee\Accountant;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller{
    
    public function accountantDashboard(){
        $accountant = Auth::user();
        return view('Backend.employees.accountants.dashboard' , compact('accountant'));
    }
}
