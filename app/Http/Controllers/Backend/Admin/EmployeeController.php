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
        $job_titles = JobTitle::all();
        $clinic = ClinicInfo::firstOrFail();

        return view('Backend.admin.employees.add', [
            'departments' => $departments,
            'job_titles'  => $job_titles,
            'clinic'      => $clinic,
            'time_start'  => $clinic->work_start,
            'time_end'    => $clinic->work_end,
            'work_days'   => $clinic->work_days, // Array (casted من JSON)
        ]);
    }


    public function storeEmployee(Request $request){
        $existingEmployee = User::where('email', $request->email)->first();
        if($existingEmployee){
            return response()->json(['data' => 0]);
        }else{
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = 'employees/' . time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('employees'), $imageName);
            } else {
                $imageName = null;
            }

            $role = (is_array($request->job_title_id) && in_array(2, $request->job_title_id)) ? 'doctor' : 'employee';

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
                'address' => $request->filled('address') ? $request->address : null,
                'image' => $imageName,
                'date_of_birth' => $request->date_of_birth,
                'gender' => $request->gender,
            ]);

            $user->assignRole([$role]);

            $employee = Employee::create([
                'user_id' => $user->id,
                'department_id' => $request->department_id,
                'work_start_time' => $request->work_start_time,
                'work_end_time' => $request->work_end_time,
                'working_days' => $request->working_days,
                'hire_date' => now()->toDateString(),
                'status' => $request->status,
                'short_biography' => $request->short_biography,
            ]);

            if(is_array($request->job_title_id)){
                foreach($request->job_title_id as $job_id){
                    EmployeeJobTitle::create([
                        'employee_id' => $employee->id,
                        'job_title_id' => $job_id,
                    ]);
                }
            }

            if(is_array($request->job_title_id) && in_array(2, $request->job_title_id)){
                Doctor::create([
                    'employee_id' => $employee->id,
                ]);
            }

            return response()->json(['data' => 1]);
        }
    }






    public function viewEmployees(){
        $employees = Employee::with('jobTitles')->orderBy('id', 'asc')->paginate(12);
        return view('Backend.admin.employees.view' , compact('employees'));
    }





    public function searchEmployees(Request $request){
        $keyword = trim((string) $request->input('keyword', ''));
        $filter  = $request->input('filter', '');

        $employees = Employee::with(['user:id,name,email,phone,address', 'department', 'jobTitles']);

        if ($keyword !== '') {
            switch ($filter) {
                case 'name':
                    $employees->whereHas('user', function ($q) use ($keyword) {
                        $q->where('name', 'like', "{$keyword}%");
                    });
                    break;

                case 'department':
                    $employees->whereHas('department', function ($q) use ($keyword) {
                        $q->where('name', 'like', "{$keyword}%");
                    });
                    break;

                case 'job_title':
                    $employees->whereHas('jobTitles', function ($q) use ($keyword) {
                        $q->where('name', 'like', "{$keyword}%");
                    });
                    break;

                case 'status':
                    $employees->where('status', 'like', "{$keyword}%");
                    break;
            }
        }

        $employees = $employees->orderBy('id')->paginate(12);

        $view       = view('Backend.admin.employees.searchEmployee', compact('employees'))->render();
        $pagination = $employees->total() > 12 ? $employees->links('pagination::bootstrap-4')->render() : '';

        return response()->json([
            'html'       => $view,
            'pagination' => $pagination,
            'count'      => $employees->total(),
            'searching'  => $keyword !== '',
        ]);
    }





    public function profileEmployee($id){
        $employee = Employee::findOrFail($id);
        return view('Backend.admin.employees.profile', compact('employee'));
    }





    public function editEmployee($id){
        $employee = Employee::findOrFail($id);
        $user = User::findOrFail($employee->user_id);

        $departments = Department::all();
        $job_titles  = JobTitle::all();

        $clinic = ClinicInfo::firstOrFail();

        return view('Backend.admin.employees.edit', [
            'employee'    => $employee,
            'user'        => $user,
            'departments' => $departments,
            'job_titles'  => $job_titles,
            'clinic'      => $clinic,
            'time_start'  => $clinic->work_start,
            'time_end'    => $clinic->work_end,
            'work_days'   => $clinic->work_days, // Array من جدول العيادة
        ]);
    }


    public function updateEmployee(Request $request, $id){
        $employee = Employee::findOrFail($id);
        $user = User::findOrFail($employee->user_id);

        // ✅ تحقق من أن الإيميل مش مكرر
        if (User::where('email', $request->email)->where('id', '!=', $user->id)->exists()) {
            return response()->json(['data' => 0]);
        }else{
            // ✅ معالجة الصورة
        $imageName = $user->image;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = 'employees/' . time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('employees'), $imageName);
        }

        // ✅ تحديث الباسوورد فقط إذا أدخل جديد
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

        // ✅ تحديث بيانات الموظف
        $employee->update([
            'department_id'   => $request->department_id,
            'work_start_time' => $request->work_start_time,
            'work_end_time'   => $request->work_end_time,
            'working_days'    => $request->working_days,
            'status'          => $request->status,
            'short_biography' => $request->short_biography,
        ]);

        // ✅ تحديث الوظائف (Job Titles)
        EmployeeJobTitle::where('employee_id', $employee->id)->delete();

        if ($request->has('job_title_id')) {
            foreach ($request->job_title_id as $jobId) {
                EmployeeJobTitle::create([
                    'employee_id'  => $employee->id,
                    'job_title_id' => $jobId,
                ]);
            }
        }

        // ✅ إذا كان الموظف دكتور (job_title_id = 2) أضف لسجل الأطباء
        if ($request->has('job_title_id') && in_array(2, $request->job_title_id)) {
            if (!$employee->doctor) {
                Doctor::create([
                    'employee_id' => $employee->id,
                ]);
            }
        } else {
            // لو شلنا التخصص من الدكتور نحذف الجدول المرتبط
            if ($employee->doctor) {
                $employee->doctor->delete();
            }
        }

        return response()->json(['data' => 1]);
        }
    }





    public function deleteEmployee($id){
        $employee = Employee::findOrFail($id);
        $user = User::findOrFail($employee->user_id);

        if ($employee->doctor) {
            $employee->doctor->delete();
        }
        EmployeeJobTitle::where('employee_id', $employee->id)->delete();

        $employee->delete();
        $user->delete();
        return response()->json(['success' => true]);
    }
}
