<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Medication;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\MedicineStock;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller{

    public function adminDashboard(){
        $department_count = Department::count();
        $doctor_count = Doctor::count();
        $employee_count = Employee::count();
        $patient_count = Patient::count();
        // $medication_count = Medication::count();
        // $medicine_stock_count = MedicineStock::count();
        // $today_appointments = Appointment::whereDate('date', today())->count();
        return view('Backend.admin.dashboard' , compact('department_count' , 'doctor_count' , 'employee_count' , 'patient_count'));
    }





    //My Profile
    public function myProfile(){
        $user = User::role('admin')->first();
        return view('Backend.admin.myprofile.view' , compact('user'));
    }





    public function editProfile(){
        $user = User::role('admin')->first();
        return view('Backend.admin.myprofile.edit' , compact('user'));
    }


    public function updateProfile(Request $request){
        $user = User::role('admin')->first();

        $password = $user->password;
        if ($request->filled('password')) {
            $password = Hash::make($request->password);
        }

        $imagePath = $user->image;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $imageName = time() . '_' . $file->getClientOriginalName();
      $file->move(public_path('assets/img/admin'), $imageName);
            $imagePath = 'assets/img/admin/' . $imageName;
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password ,
            'phone' => $request->phone,
            'address' => $request->address,
            'image' => $imagePath,
            'date_of_birth' => $request->date_of_birth,
            'gender' => $request->gender,
        ]);

        return response()->json(['data' => 1]);
    }
}
