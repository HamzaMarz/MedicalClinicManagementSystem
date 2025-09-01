<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\User;
use App\Models\Medication;
use Illuminate\Http\Request;
use App\Models\MedicineStock;
use App\Models\MedicationRequest;
use App\Models\MedicationPharmacy;
use App\Http\Controllers\Controller;
use App\Notifications\NewMedicationRequestNotification;

class MedicationRequestController extends Controller{

    public function addMedicationRequest(){
        $medications = Medication::all();
        return view('Backend.admin.requests.addMedication' , compact('medications'));
    }



    // 1. الأدمن يعمل طلب
    public function storeMedicationRequest(Request $request){
        $medication = Medication::findOrFail($request->medication_id);
        MedicationRequest::create([
            'medication_id' => $medication->id,
            'admin_id' => auth()->id(),
            'requested_quantity' => $request->quantity,
            'status' => 'pending',
        ]);

        $supervisors = User::whereHas('employee.jobTitles', function ($query) {
            $query->where('name', 'Store Supervisor');
        })->get();

        foreach ($supervisors as $supervisor) {
            $supervisor->notify(
                new NewMedicationRequestNotification($medication, $request->quantity, auth()->user())
            );
        }

        return response()->json(['data' => 1]);
    }






    // عدل واعتمدها
    // public function index(){
    //     $requests = MedicationRequest::with('medication')->orderBy('created_at', 'desc')->paginate(12);
    //     return view('Backend.admin.requests.index', compact('requests'));
    // }

}
