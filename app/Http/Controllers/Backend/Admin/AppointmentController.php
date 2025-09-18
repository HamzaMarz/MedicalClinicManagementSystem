<?php

namespace App\Http\Controllers\Backend\Admin;


use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Department;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AppointmentController extends Controller{

    public function addAppointment(){
        $patients = Patient::all();
        $departments = Department::all();
        $doctors = Doctor::all();
        return view('Backend.admin.appointments.add' , compact('patients' , 'doctors' , 'departments'));
    }


    public function storeAppointment(Request $request){
        $selectedDay = $request->appointment_day;
        $selectedTime = $request->appointment_time;

        $appointmentDate = Carbon::parse("this $selectedDay");

        if($appointmentDate->isToday()) {
            $selectedDateTime = Carbon::parse($appointmentDate->toDateString() . ' ' . $selectedTime);
            if($selectedDateTime->lt(Carbon::now())) {
                return response()->json(['data' => 2]);    // عندما تحدد موعد في نفس اليوم لكن الوقت انتهى
            }
        }elseif($appointmentDate->isPast()) {
            $appointmentDate = Carbon::parse("next $selectedDay");
        }

        $appointmentDate = $appointmentDate->toDateString();

        $exists = Appointment::where('patient_id', $request->patient_id)
            ->where('doctor_id', $request->doctor_id)
            ->where('department_id', $request->department_id)
            ->where('date', $appointmentDate)
            ->where('time', $request->appointment_time)
            ->exists();

        if ($exists) {
            return response()->json(['data' => 0]);     // المريض عنده نفس الموعد
        }

        // تحقق من التعارض مع مريض آخر عند نفس الدكتور
        $conflict = Appointment::where('doctor_id', $request->doctor_id)
            ->where('date', $appointmentDate)
            ->where('time', $request->appointment_time)
            ->exists();

        if ($conflict) {
            return response()->json(['data' => 1]);     // الموعد محجوز
        }


        $consultation_fee = Doctor::where('id' , $request->doctor_id)->value('consultation_fee');
        Appointment::create([
            'patient_id'        => $request->patient_id,
            'doctor_id'         => $request->doctor_id,
            'department_id'     => $request->department_id,
            'date'              => $appointmentDate,
            'time'              => $request->appointment_time,
            'consultation_fee'  => $consultation_fee,
            'notes'             => $request->notes,
            'status'            => 'Pending',
        ]);

        return response()->json(['data' => 3]);      // تم الحجز بنجاح
    }






    public function viewAppointments(){
        $appointments = Appointment::orderBy('id', 'asc')->paginate(12);
        return view('Backend.admin.appointments.view' , compact('appointments'));
    }





    public function searchAppointments(Request $request){
        $keyword = trim((string) $request->input('keyword', ''));
        $filter  = $request->input('filter', '');

        $appointments = Appointment::with(['patient.user', 'department', 'doctor.user']);

        if ($keyword !== '') {
            switch ($filter) {
                case 'patient':
                    $appointments->whereHas('patient.user', function ($q) use ($keyword) {
                        $q->where('name', 'like', "{$keyword}%");
                    });
                    break;

                case 'department':
                    $appointments->whereHas('department', function ($q) use ($keyword) {
                        $q->where('name', 'like', "{$keyword}%");
                    });
                    break;

                case 'doctor':
                    $appointments->whereHas('doctor.user', function ($q) use ($keyword) {
                        $q->where('name', 'like', "{$keyword}%");
                    });
                    break;

                case 'date':
                    $appointments->where('date', 'like', "{$keyword}%");
                    break;

                case 'status':
                    $appointments->where('status', 'like', "{$keyword}%");
                    break;
            }
        }

        $appointments = $appointments->orderBy('id')->paginate(12);

        $view       = view('Backend.admin.appointments.searchAppointment', compact('appointments'))->render();
        $pagination = $appointments->total() > 12 ? $appointments->links('pagination::bootstrap-4')->render() : '';

        return response()->json([
            'html'       => $view,
            'pagination' => $pagination,
            'count'      => $appointments->total(),
            'searching'  => $keyword !== '',
        ]);
    }





    public function detailsAppointment($id){
        $appointment = Appointment::findOrFail($id);
        return view('Backend.admin.appointments.details', compact('appointment'));
    }





    public function editAppointment($id){
        $appointment = Appointment::findOrFail($id);
        $patients = Patient::all();
        $departments = Department::all();
        return view('Backend.admin.appointments.edit', compact('patients' , 'appointment' , 'departments'));
    }


    public function updateAppointment(Request $request, $id){
        $selectedDay = $request->appointment_day;
        $selectedTime = $request->appointment_time;

        $appointmentDate = Carbon::parse("this $selectedDay");

        if ($appointmentDate->isToday()) {
            $selectedDateTime = Carbon::parse($appointmentDate->toDateString() . ' ' . $selectedTime);
            if ($selectedDateTime->lt(Carbon::now())) {
                return response()->json(['data' => 2]);   // الموعد انتهى وقته
            }
        } elseif ($appointmentDate->isPast()) {
            $appointmentDate = Carbon::parse("next $selectedDay");
        }

        $appointmentDate = $appointmentDate->toDateString();

        $exists = Appointment::where('patient_id', $request->patient_id)
            ->where('doctor_id', $request->doctor_id)
            ->where('department_id', $request->department_id)
            ->where('date', $appointmentDate)
            ->where('time', $request->appointment_time)
            ->where('id', '!=', $id)
            ->exists();

        if ($exists) {
            return response()->json(['data' => 0]);   // المريض عنده نفس الموعد
        }

        $conflict = Appointment::where('doctor_id', $request->doctor_id)
            ->where('date', $appointmentDate)
            ->where('time', $request->appointment_time)
            ->where('id', '!=', $id)
            ->exists();

        if ($conflict) {
            return response()->json(['data' => 1]);   // الموعد محجوز
        }

        $appointment = Appointment::findOrFail($id);
        $consultation_fee = Doctor::where('id', $request->doctor_id)->value('consultation_fee');

        $appointment->update([
            'patient_id'        => $request->patient_id,
            'doctor_id'         => $request->doctor_id,
            'department_id'     => $request->department_id,
            'date'              => $appointmentDate,
            'time'              => $request->appointment_time,
            'consultation_fee'  => $consultation_fee,
            'notes'             => $request->notes,
        ]);

        return response()->json(['data' => 3]);   // تم التعديل بنجاح
    }






    public function deleteAppointment($id){
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();
        return response()->json(['success' => true]);
    }





    public function searchPatients(Request $request){
        $keyword = $request->get('keyword', '');
        $patients = Patient::with('user')
            ->whereHas('user', function ($q) use ($keyword) {
                $q->where('name', 'like', "{$keyword}%");
            })
            ->limit(20) ->get();

        return response()->json($patients->map(function($patient) {
            return [
                'id'   => $patient->id,
                'name' => $patient->user->name,
            ];
        }));
    }

}
