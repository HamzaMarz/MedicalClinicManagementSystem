<?php

namespace App\Http\Controllers\Backend\DepartmentManager;

use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Employee;
use App\Models\Specialty;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller{

    public function departmentManagerDashboard(){
        $department_manager = Auth::user();
        $department = $department_manager->employee->department;
        $specialty_count = $department->specialties()->count();
        $doctor_count = Doctor::whereIn('employee_id' , Employee::where('department_id', $department->id)->pluck('id'))->count();
        $employee_count = Employee::where('department_id', $department->id)->count();
        $patient_count = $department->patients()->count();

        return view('Backend.departments_managers.dashboard' , compact('department_manager',
            'specialty_count',
            'doctor_count',
            'employee_count',
            'patient_count',
        ));
    }




    public function departmentManagerProfile(){
        $department_manager = Auth::user();
        $department = $department_manager->employee->department;
        return view('Backend.departments_managers.profile.view' , compact('department_manager' , 'department'));
    }



}
