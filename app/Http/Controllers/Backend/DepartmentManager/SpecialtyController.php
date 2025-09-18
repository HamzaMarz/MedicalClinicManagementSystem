<?php

namespace App\Http\Controllers\Backend\DepartmentManager;

use App\Models\Doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SpecialtyController extends Controller{

    public function viewSpecialties(){
        $department_manager = Auth::user();
        $department = $department_manager->employee->department;
        $specialties = $department->specialties;
        return view('Backend.departments_managers.specialties.view' , compact('specialties'));
    }




    public function detailsSpecialty($id){
        $department_manager = Auth::user();
        $department = $department_manager->employee->department;
        $specialty = $department->specialties()->findOrFail($id);
        $count_departments = $specialty->departments()->count();
        $count_doctors = Doctor::where('specialty_id' , $specialty->id)->count();
        return view('Backend.departments_managers.specialties.details' , compact('specialty',
            'count_departments',
            'count_doctors',
        ));
    }
}
