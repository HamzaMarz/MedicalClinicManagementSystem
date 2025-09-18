<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Prescription;
use Illuminate\Http\Request;
use App\Models\PrescriptionItem;
use App\Http\Controllers\Controller;

class PrescriptionController extends Controller{

    public function viewPrescriptions(){
        $prescriptions = Prescription::orderBy('id', 'asc')->paginate(12);
        return view ('Backend.admin.prescriptions.view' , compact('prescriptions'));
    }





    public function searchPrescriptions(Request $request){
        $query = Prescription::with(['patient.user', 'appointment.department', 'doctor.employee.user']);

        $keyword = $request->input('keyword');
        $filter  = $request->input('filter');

        if (!empty($keyword)) {
            switch ($filter) {
                case 'patient_name':
                    $query->whereHas('patient.user', function($q) use ($keyword) {
                        $q->where('name', 'LIKE', "{$keyword}%");
                    });
                    break;

                case 'department':
                    $query->whereHas('appointment.department', function($q) use ($keyword) {
                        $q->where('name', 'LIKE', "{$keyword}%");
                    });
                    break;

                case 'doctor_name':
                    $query->whereHas('doctor.employee.user', function($q) use ($keyword) {
                        $q->where('name', 'LIKE', "{$keyword}%");
                    });
                    break;
            }
        }

        $prescriptions = $query->paginate(10);

        return response()->json([
            'html'       => view('Backend.admin.prescriptions.searchPrescriptions', compact('prescriptions'))->render(),
            'count'      => $prescriptions->total(),
            'searching'  => $keyword !== '',
            'pagination' => $prescriptions->links('pagination::bootstrap-4')->render(),
        ]);
    }





    public function viewItemsPrescriptions(){
        $prescription_items = PrescriptionItem::all();
        return view ('Backend.admin.prescriptions.itemView' , compact('prescription_items'));
    }





    public function deletePrescription($id){

    }
}
