<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller{


    public function addDepartment(){
        return view('Backend.admin.departments.add');
    }


    public function storeDepartment(Request $request){
        if(Department::where('name' , $request->name)->exists()){
            return response()->json(['data' => 0]);
        }else{
            Department::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return response()->json(['data' => 1]);
        }
    }





    public function viewDepartments(){
        $departments = Department::orderBy('id', 'asc')->paginate(10);
        return view('Backend.admin.departments.view', compact('departments'));
    }





    public function descriptionDepartment($id){
        $department = Department::with('doctors')->findOrFail($id);
        $departmentIds = Department::where('id', $id)->pluck('id');
        $count_doctor = Doctor::whereIn('department_id', $departmentIds)->count();
        return view('Backend.admin.departments.description', compact('department' , 'count_doctor'));
    }





    public function editDepartment($id){
        $department = Department::findOrFail($id);
        return view('Backend.admin.departments.edit', compact('department'));
    }


    public function updateDepartment(Request $request, $id){
        $department = Department::findOrFail($id);
        $department->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json(['data' => 1]);
    }




    public function deleteDepartment($id){
        $department = Department::findOrFail($id);
        $doctors = Doctor::where('department_id', $id)->get();

        foreach ($doctors as $doctor) {
            $employee = Employee::find($doctor->employee_id);

            if ($employee) {
                if ($employee->user_id) {
                    User::where('id', $employee->user_id)->delete();
                }
                $employee->delete();
            }
            $doctor->delete();
        }

        $department->delete();

        return response()->json(['success' => true]);
    }





    public function viewDepartmentsManagers(){
        return view('Backend.admin.departments.departments_managers.view');
    }
}
