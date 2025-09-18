<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Employee;
use App\Models\JobTitle;
use App\Models\Specialty;
use App\Models\ClinicInfo;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Models\EmployeeJobTitle;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class DepartmentController extends Controller{


    public function addDepartment(){
        $specialties = Specialty::all();
        return view('Backend.admin.departments.add' , compact('specialties'));
    }


    public function storeDepartment(Request $request){
        if(Department::where('name' , $request->name)->exists()){
            return response()->json(['data' => 0]);
        }else{
            $department = Department::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            // ربط التخصصات
            if ($request->has('specialties') && is_array($request->specialties)) {
                $department->specialties()->attach($request->specialties);
            }

            return response()->json(['data' => 1]);
        }
    }





    public function viewDepartments(){
        $departments = Department::orderBy('id', 'asc')->paginate(10);
        return view('Backend.admin.departments.view', compact('departments'));
    }





    public function detailsDepartment($id){
        $department = Department::with(['doctors'])->findOrFail($id);
        $count_specialties = $department->specialties()->count();
        $count_doctor = $department->doctors()->count();

        return view('Backend.admin.departments.details', compact(
            'department',
            'count_specialties',
            'count_doctor'
        ));
    }





    public function editDepartment($id){
        $department = Department::findOrFail($id);
        $specialties = Specialty::all();
        return view('Backend.admin.departments.edit', compact('department' , 'specialties'));
    }


    public function updateDepartment(Request $request, $id){
        $department = Department::findOrFail($id);
        $department->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $department->specialties()->sync($request->specialties ?? []);

        return response()->json(['data' => 1]);
    }



    public function deleteDepartment($id){
        $department = Department::findOrFail($id);
        $employees = Employee::where('department_id', $id)->get();

        foreach ($employees as $employee) {
            $doctor = Doctor::where('employee_id', $employee->id)->first();

            if ($doctor) {
                $doctor->delete();
            }

            if ($employee->user_id) {
                User::where('id', $employee->user_id)->delete();
            }

            $employee->delete();
        }

        $department->specialties()->detach();
        $department->delete();
        return response()->json(['success' => true]);
    }






    public function viewDepartmentsManagers(){
        $job_title_id = JobTitle::where('name' , 'Department Manager')->pluck('id')->first();
        $departments_managers = EmployeeJobTitle::where('job_title_id' , $job_title_id)->paginate(8);
        return view('Backend.admin.departments.departments_managers.view' , compact('departments_managers'));
    }




    public function searchDepartmentsManagers(Request $request){
        $keyword = trim((string) $request->input('keyword', ''));
        $filter  = $request->input('filter', '');

        $query = User::role('department_manager');

        if ($keyword !== '') {
            if ($filter === 'name') {
                $query->where('name', 'like', $keyword.'%');
            }
        }

        $departments_managers = $query->orderBy('id')->paginate(12);

        $html = view('Backend.admin.departments.departments_managers.search', compact('departments_managers'))->render();

        return response()->json([
            'html'       => $html,
            'count'      => $departments_managers->total(),
            'searching'  => $keyword !== '',
            'pagination' => $departments_managers->links('pagination::bootstrap-4')->render(),
        ]);
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

