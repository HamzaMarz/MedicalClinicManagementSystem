<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Employee;
use App\Models\JobTitle;
use App\Models\ClinicInfo;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\EmployeeJobTitle;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

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
        $job_title_id = JobTitle::where('name' , 'Department Manager')->pluck('id')->first();
        $departmentsManagers = EmployeeJobTitle::where('job_title_id' , $job_title_id)->paginate(8);
        return view('Backend.admin.departments.departments_managers.view' , compact('departmentsManagers'));
    }



    public function profileDepartmentManager($id){
        $departmentManager = Employee::where('id' , $id)->first();
        return view('Backend.admin.departments.departments_managers.profile' , compact('departmentManager'));
    }



    public function editDepartmentManager($id){
        $departmentManager = Employee::where('id' , $id)->first();
        $user = User::findOrFail($departmentManager->user_id);
        $departments = Department::all();

        $clinic = ClinicInfo::firstOrFail();

        return view('Backend.admin.departments.departments_managers.edit', [
            'departmentManager'=> $departmentManager,
            'user'        => $user,
            'departments' => $departments,
            'clinic'      => $clinic,
            'time_start'  => $clinic->work_start,
            'time_end'    => $clinic->work_end,
            'work_days'   => $clinic->work_days, 
        ]);
    }


    public function updateDepartmentManager(Request $request , $id){
        $departmentManager = Employee::findOrFail($id);
        $user = User::findOrFail($departmentManager->user_id);

        if (User::where('email', $request->email)->where('id', '!=', $user->id)->exists()) {
            return response()->json(['data' => 0]);
        }else{
            $imageName = $user->image;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = 'employees/' . time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('employees'), $imageName);
            }

            $password = $user->password;
            if ($request->filled('password')) {
                $password = Hash::make($request->password);
            }

            $user->update([
                'name'         => $request->name,
                'email'        => $request->email,
                'password'     => $password,
                'phone'        => $request->phone,
                'address'      => $request->filled('address') ? $request->address : null,
                'image'        => $imageName,
                'date_of_birth'=> $request->date_of_birth,
                'gender'       => $request->gender,
            ]);

            $departmentManager->update([
                'department_id'   => $request->department_id,
                'work_start_time' => $request->work_start_time,
                'work_end_time'   => $request->work_end_time,
                'working_days'    => $request->working_days,
                'status'          => $request->status,
                'short_biography' => $request->short_biography,
            ]);
            return response()->json(['data' => 1]);
        }
    }





    public function deleteDepartmentManager($id){
        $departmentManager = Employee::findOrFail($id);
        $user = User::findOrFail($departmentManager->user_id);

        if ($departmentManager->doctor) {
            $departmentManager->doctor->delete();
        }
        EmployeeJobTitle::where('employee_id', $departmentManager->id)->delete();

        $departmentManager->delete();
        $user->delete();
        return response()->json(['success' => true]);
    }
}

