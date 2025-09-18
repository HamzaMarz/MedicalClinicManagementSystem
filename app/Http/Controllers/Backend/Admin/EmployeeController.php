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

class EmployeeController extends Controller{

    public function addEmployee(){
        $departments = Department::all();
        $job_titles  = JobTitle::all();
        $doctors     = Doctor::with('employee')->get();
        $clinic = ClinicInfo::firstOrFail();

        return view('Backend.admin.employees.add', compact(
            'departments',
            'job_titles',
            'clinic',
            'doctors'
        ));
    }


    public function storeEmployee(Request $request){
        $existingEmployee = User::where('name', $request->name)->where('email', $request->email)->first();
        if($existingEmployee){
            return response()->json(['data' => 0]);
        }else{

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('assets/img/employees'), $imageName);
                $imagePath = 'assets/img/employees/' . $imageName;
            } else {
                $imagePath = null;
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'address' => $request->filled('address') ? $request->address : null,
                'image' => $imagePath,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
            ]);


            $employee = Employee::create([
                'user_id' => $user->id,
                'department_id' => $request->department_id,
                'work_start_time' => $request->work_start_time,
                'work_end_time' => $request->work_end_time,
                'working_days' => $request->working_days,
                'status' => $request->status,
                'short_biography' => $request->short_biography,
            ]);


            if(is_array($request->job_title_id)){
                foreach($request->job_title_id as $job_id){
                    EmployeeJobTitle::create([
                        'employee_id' => $employee->id,
                        'job_title_id' => $job_id,
                        'hire_date' => now()->toDateString(),
                    ]);
                }
            }

            if (is_array($request->job_title_id)) {
                $doctorTitle = JobTitle::whereIn('id', $request->job_title_id)
                    ->where('name', 'Doctor')
                    ->first();

                if ($doctorTitle) {
                    Doctor::create([
                        'employee_id' => $employee->id,
                        'qualification' => $request->qualification,
                        'experience_years' => $request->experience_years,
                        'specialty_id' => $request->specialty_id,
                        'consultation_fee' => $request->consultation_fee,
                    ]);
                }
            }

            if ($request->job_title_id) {
                $jobTitles = JobTitle::whereIn('id', $request->job_title_id)->pluck('name')->toArray();

                $roles = [];

                if (in_array('Department Manager', $jobTitles)) {
                    $roles[] = 'department_manager';
                }

                if (in_array('Doctor', $jobTitles)) {
                    $roles[] = 'doctor';
                }

                if (array_intersect(['Receptionist', 'Nurse', 'Accountant', 'Pharmacist', 'Store Supervisor'], $jobTitles)) {
                    $roles[] = 'employee';
                }

                $user->syncRoles($roles);
            }

            return response()->json(['data' => 1]);
        }
    }





    public function viewEmployees(){
        $employees = Employee::orderBy('id', 'asc')->paginate(12);
        return view('Backend.admin.employees.view' , compact('employees'));
    }





    public function searchEmployees(Request $request){
        $query = Employee::with(['user', 'jobTitles', 'department']);

        $keyword = $request->input('keyword');
        $filter  = $request->input('filter');

        if (!empty($keyword)) {
            switch ($filter) {
                case 'name':  
                    $query->whereHas('user', function($q) use ($keyword) {
                        $q->where('name', 'LIKE', "{$keyword}%");
                    });
                    break;

                case 'job_title':  
                    $query->whereHas('jobTitles', function($q) use ($keyword) {
                        $q->where('name', 'LIKE', "{$keyword}%");
                    });
                    break;

                case 'department': 
                    $query->whereHas('department', function($q) use ($keyword) {
                        $q->where('name', 'LIKE', "{$keyword}%");
                    });
                    break;

                case 'status': 
                    $query->where('status', 'LIKE', "{$keyword}%");
                    break;
            }
        }

        $employees = $query->paginate(10);

        return response()->json([
            'html'       => view('Backend.admin.employees.searchEmployee', compact('employees'))->render(),
            'count'      => $employees->total(),
            'searching'  => $keyword !== '',
            'pagination' => $employees->links('pagination::bootstrap-4')->render(),
        ]);
    }





    public function profileEmployee($id){
        $employee = Employee::findOrFail($id);
        return view('Backend.admin.employees.profile', compact('employee'));
    }





    public function editEmployee($id){
        $employee = Employee::findOrFail($id);
        $user = User::where('id', $employee->user_id)->first();
        $departments = Department::all();
        $jobTitles = JobTitle::all();
        $clinic = ClinicInfo::firstOrFail();
        return view('Backend.admin.employees.edit', compact('employee' ,
         'user' ,
          'departments',
           'jobTitles',
           'clinic',
        ));
    }


    public function updateEmployee(Request $request, $id){
        $employee = Employee::findOrFail($id);
        $user = User::findOrFail($employee->user_id);

        if (User::where('name', $request->name)->where('id', '!=', $user->id)->exists() || User::where('email', $request->email)->where('id', '!=', $user->id)->exists()) {
            return response()->json(['data' => 0]);
        }

        $imagePath = $user->image;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img/employees'), $imageName);
            $imagePath = 'assets/img/employees/' . $imageName;
        }

        $password = $user->password;
        if ($request->filled('password')) {
            $password = Hash::make($request->password);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'phone' => $request->phone,
            'address' => $request->filled('address') ? $request->address : null,
            'image' => $imagePath,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
        ]);

        $employee->update([
            'department_id' => $request->department_id,
            'work_start_time' => $request->work_start_time,
            'work_end_time' => $request->work_end_time,
            'working_days' => $request->working_days,
            'status' => $request->status,
            'short_biography' => $request->short_biography,
        ]);

        if (is_array($request->job_title_id)) {
            $currentJobTitles = EmployeeJobTitle::where('employee_id', $employee->id)->pluck('job_title_id')->toArray();

            foreach ($request->job_title_id as $job_id) {
                EmployeeJobTitle::updateOrCreate(
                    ['employee_id' => $employee->id, 'job_title_id' => $job_id],
                    ['hire_date' => in_array($job_id, $currentJobTitles)
                        ? EmployeeJobTitle::where('employee_id', $employee->id)->where('job_title_id', $job_id)->value('hire_date')
                        : now()->toDateString()
                    ]
                );
            }

            EmployeeJobTitle::where('employee_id', $employee->id)
                ->whereNotIn('job_title_id', $request->job_title_id)
                ->delete();
        }

        if (is_array($request->job_title_id)) {
            $doctorTitle = JobTitle::whereIn('id', $request->job_title_id)
                ->where('name', 'Doctor')
                ->first();

            if ($doctorTitle) {
                Doctor::updateOrCreate(
                    ['employee_id' => $employee->id],
                    [
                        'qualification' => $request->qualification,
                        'experience_years' => $request->experience_years,
                        'specialty_id' => $request->specialty_id,
                        'consultation_fee' => $request->consultation_fee,
                    ]
                );
            } else {
                Doctor::where('employee_id', $employee->id)->delete();
            }
        }

        if ($request->job_title_id) {
            $jobTitles = JobTitle::whereIn('id', $request->job_title_id)->pluck('name')->toArray();

            $roles = [];

            if (in_array('Department Manager', $jobTitles)) {
                $roles[] = 'department_manager';
            }

            if (in_array('Doctor', $jobTitles)) {
                $roles[] = 'doctor';
            }

            if (array_intersect(['Receptionist', 'Nurse', 'Accountant', 'Pharmacist', 'Store Supervisor'], $jobTitles)) {
                $roles[] = 'employee';
            }

            $user->syncRoles($roles);
        }

        return response()->json(['data' => 1]);
    }





    public function deleteEmployee($id){
        $employee = Employee::findOrFail($id);
        $user = User::findOrFail($employee->user_id);
        Doctor::where('employee_id', $employee->id)->delete();
        EmployeeJobTitle::where('employee_id', $employee->id)->delete();
        $employee->delete();
        $user->delete();
        return response()->json(['success' => true]);
    }




    public function getSpecialtiesByDepartment($department_id){
        $department = Department::with('specialties')->findOrFail($department_id);
        return response()->json($department->specialties);
    }

}
