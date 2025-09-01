<?php

namespace App\Http\Controllers\Backend\DepartmentManager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller{

    public function departmentManagerDashboard(){
        $department_manager = Auth::user();
        return view('Backend.departments_managers.dashboard' , compact('department_manager'));
    }
}
