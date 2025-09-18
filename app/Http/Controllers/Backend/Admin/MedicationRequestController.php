<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\User;
use App\Models\Medication;
use Illuminate\Http\Request;
use App\Models\MedicationRequest;
use App\Http\Controllers\Controller;
use App\Notifications\store_supervisor\NewMedicationRequestNotification;

class MedicationRequestController extends Controller{

    /* ============================
     *   طلبات الصيدلية
     * ============================ */

    public function createPharmacyRequest(){
        $medications = Medication::all();
        return view('Backend.admin.requests.pharmacy.add', compact('medications'));
    }


    public function storePharmacyRequest(Request $request){
        $medication = Medication::findOrFail($request->medication_id);

        $medicationRequest = MedicationRequest::create([
            'medication_id'      => $medication->id,
            'admin_id'           => auth()->id(),
            'requested_quantity' => $request->quantity,
            'request_type'       => 'pharmacy',
            'unit_type'          => 'box',
            'status'             => 'pending',
        ]);


        $supervisors = User::whereHas('employee.jobTitles', function ($query) {
            $query->where('name', 'Store Supervisor');
        })->get();

        foreach ($supervisors as $supervisor) {
            $supervisor->notify(
                new NewMedicationRequestNotification($medicationRequest->id, $medication, $request->quantity, auth()->user())
            );
        }

        return response()->json(['data' => 1]);
    }

    // عرض كل طلبات الصيدلية
    // public function pharmacyRequests(){
    //     $requests = MedicationRequest::with('medication')
    //         ->where('request_type', 'pharmacy')
    //         ->orderBy('created_at', 'desc')
    //         ->paginate(12);

    //     return view('Backend.admin.requests.pharmacy.index', compact('requests'));
    // }


    /* ============================
     *   طلبات المخزن
     * ============================ */

    public function createStoreRequest(){
        $medications = Medication::all();
        return view('Backend.admin.requests.store.add', compact('medications'));
    }


    public function storeStoreRequest(Request $request){
        $medication = Medication::findOrFail($request->medication_id);

        $medicationRequest = MedicationRequest::create([
            'medication_id'      => $medication->id,
            'admin_id'           => auth()->id(),
            'requested_quantity' => $request->quantity,
            'request_type'       => 'store',
            'unit_type'          => 'carton',
            'status'             => 'pending',
        ]);

        $supervisors = User::whereHas('employee.jobTitles', function ($query) {
            $query->where('name', 'Pharmacy Supervisor');
        })->get();

        foreach ($supervisors as $supervisor) {
            $supervisor->notify(
                new NewMedicationRequestNotification($medicationRequest->id, $medication, $request->quantity, auth()->user())
            );
        }

        return response()->json(['data' => 1]);
    }





    public function medicationRequests($id){
        $requests = MedicationRequest::with('medication')->findOrFail($id);
        return view('Backend.admin.requests.medicationRequests', compact('requests'));
    }
}
