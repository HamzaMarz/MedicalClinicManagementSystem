<?php

namespace App\Http\Controllers\Backend\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Clinic;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\ClinicPatient;
use App\Models\ClinicDepartment;
use App\Models\DepartmentPatient;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class PatientController extends Controller{

    public function addPatient(){
        $departments = Department::all();
        $doctors = Doctor::all();
        return view('Backend.admin.patients.add' , compact('departments' , 'doctors'));
    }


    public function storePatient(Request $request){

        $appointmentDate = Carbon::parse("next {$request->appointment_day}")->toDateString();

        $conflict = Appointment::where('doctor_id', $request->doctor_id)
            ->where('date', $appointmentDate)
            ->where('time', $request->appointment_time)
            ->exists();

        if ($conflict) {
            return response()->json(['data' => 1]); // هذا الموعد محجوز
        }

        // المستخدم موجود؟
        $user = User::where('email', $request->email)->orWhere('name', $request->name)->first();

        if ($user) {

            $patient = Patient::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'blood_type'        => $request->blood_type,
                    'emergency_contact' => $request->emergency_contact,
                    'allergies'         => $request->allergies,
                    'chronic_diseases'  => $request->chronic_diseases,
                ]
            );


            DepartmentPatient::firstOrCreate([
                'patient_id' => $patient->id,
                'department_id' => $request->department_id
            ]);

            // أنشئ الموعد
            Appointment::create([
                'patient_id'           => $patient->id,
                'doctor_id'            => $request->doctor_id,
                'department_id'         => $request->department_id,
                'date'                 => $appointmentDate,
                'time'                 => $request->appointment_time,
                'status'               => 'Pending',
                'notes'                => $request->notes,
            ]);

            return response()->json(['data' => 2]); // تم الحفظ
        }

        // المستخدم غير موجود - أنشئه ثم كمل
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('patients'), $filename);
            $imageName = 'patients/'.$filename;
        } else {
            $imageName = null;
        }

        $user = User::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'password'     => Hash::make($request->password),
            'phone'        => $request->phone,
            'address'      => $request->address,
            'image'        => $imageName,
            'date_of_birth'=> $request->date_of_birth,
            'gender'       => $request->gender,
        ]);
        $user->assignRole('patient');

        $patient = Patient::create([
            'user_id'           => $user->id,
            'blood_type'        => $request->blood_type,
            'emergency_contact' => $request->emergency_contact,
            'allergies'         => $request->allergies,
            'chronic_diseases'  => $request->chronic_diseases,
        ]);

        

        DepartmentPatient::firstOrCreate([
            'patient_id' => $patient->id,
            'department_id' => $request->department_id
        ]);

        Appointment::create([
            'patient_id'           => $patient->id,
            'doctor_id'            => $request->doctor_id,
            'department_id'        => $request->department_id,
            'date'                 => $appointmentDate,
            'time'                 => $request->appointment_time,
            'status'               => 'Pending',
            'notes'                => $request->notes,
        ]);

        return response()->json(['data' => 2]);
    }






    public function viewPatients(){
        $patients = Patient::orderBy('id', 'asc')->paginate(12);
        return view('Backend.admin.patients.view' , compact('patients'));
    }





    public function searchPatients(Request $request){
        $keyword = trim((string) $request->input('keyword', ''));
        $filter  = $request->input('filter', '');

        $patients = Patient::with('user:id,name,email,phone,address');

        if ($keyword !== '') {
            switch ($filter) {
                case 'name':
                    $patients->whereHas('user', fn($q) => $q->where('name', 'like', "{$keyword}%"));
                    break;
            }
        }

        $patients   = $patients->orderBy('id')->paginate(12);
        $view       = view('Backend.admin.patients.searchPatient', compact('patients'))->render();
        $pagination = $patients->total() > 12 ? $patients->links('pagination::bootstrap-4')->render() : '';

        return response()->json([
            'html'       => $view,
            'pagination' => $pagination,
            'count'      => $patients->total(),
            'searching'  => $keyword !== '',
        ]);
    }





    public function profilePatient($id){
        $patient = Patient::findOrFail($id);
        return view('Backend.admin.patients.profile', compact('patient'));
    }





    public function editPatient($id){
        $patient = Patient::with('user')->findOrFail($id);
        $user = $patient->user;
        return view('Backend.admin.patients.edit', compact('patient','user'));
    }


    public function updatePatient(Request $request, $id){
        $patient = Patient::findOrFail($id);
        $user    = User::findOrFail($patient->user_id);

        $patientExists = User::where(function ($query) use ($request) {
            $query->where('email', $request->email)->orWhere('name', $request->name);
        })->where('id', '!=', $user->id)->exists();

        if ($patientExists) {
            return response()->json(['data' => 0]);
        }else{
            $imagePath = $user->image;
        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('patients'), $filename);
            $imagePath = 'patients/'.$filename;
        }

        $password = $user->password;
        if ($request->filled('password')) {
            $password = Hash::make($request->password);
        }

        $user->update([
            'name'          => $request->name,
            'email'         => $request->email,
            'password'      => $password,
            'phone'         => $request->phone,
            'address'       => $request->filled('address') ? $request->address : null,
            'image'         => $imagePath,
            'date_of_birth' => $request->date_of_birth,
            'gender'        => $request->gender,
        ]);


        $patient->update([
            'blood_type'        => $request->blood_type,
            'emergency_contact' => $request->emergency_contact,
            'allergies'         => $request->allergies,
            'chronic_diseases'  => $request->chronic_diseases,
        ]);

        return response()->json(['data' => 1]);
        }


    }




    public function deletePatient($id){
        $patient = Patient::findOrFail($id);
        $user = User::where('id', $patient->user_id)->first();

        $patient->delete();
        $user->delete();
        return response()->json(['success' => true]);
    }





    public function getDoctorsByDepartment($department_id){
        $doctors = Doctor::whereHas('employee', function ($query) use ($department_id) {
            $query->where('department_id', $department_id);
        })->with(['employee.user'])->get();
    
        $data = $doctors->map(function($doctor) {
            return [
                'id'   => $doctor->id,
                'name' => $doctor->employee->user->name ?? 'Unknown'
            ];
        });
    
        return response()->json($data);
    }
    
    
    public function getDoctorInfo($id){
        $doctor = Doctor::with('employee')->findOrFail($id);

        return response()->json([
            'work_start_time' => $doctor->employee->work_start_time,
            'work_end_time'   => $doctor->employee->work_end_time,
        ]);
    }


    public function getWorkingDays($id){
        $doctor = Doctor::findOrFail($id);
        $days = $doctor->employee->working_days ?? [];
        return response()->json($days);
    }

}
