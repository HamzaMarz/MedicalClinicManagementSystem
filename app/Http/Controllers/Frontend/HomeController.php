<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller{

    public function home(){
        $admin = User::role('admin')->first();
        $departments = Department::all();
        $department_count = Department::count();
        $employee_count = Employee::count();
        $doctor_count = Doctor::count();
        $doctors = Doctor::inRandomOrder()->take(4)->get();
        $patient_count = Patient::count();
        return view('Frontend.master' , compact( 'admin' , 'departments' , 'department_count' , 'employee_count' , 'doctor_count' , 'doctors' , 'patient_count'));
    }
}
