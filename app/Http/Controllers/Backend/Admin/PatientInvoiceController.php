<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\PatientInvoice;
use App\Http\Controllers\Controller;
use App\Models\ClinicInfo;

class PatientInvoiceController extends Controller{

    public function viewPatientsInvoices(){
        $patients_invoices = PatientInvoice::orderBy('id', 'asc')->paginate(12);
        return view('Backend.admin.patientsinvoices.invoices.view' , compact('patients_invoices'));
    }




    public function searchPatientsInvoices(Request $request){
        $keyword = $request->input('keyword');
        $filter  = $request->input('filter');

        $query = PatientInvoice::with(['appointment.patient.user']);

        if ($keyword) {
            if ($filter === 'appointment_id') {
                $query->whereHas('appointment', function ($q) use ($keyword) {
                    $q->where('id', 'like', "$keyword%");
                });
            } elseif ($filter === 'patient_name') {
                $query->whereHas('appointment.patient.user', function ($q) use ($keyword) {
                    $q->where('name', 'like', "$keyword%");
                });
            } elseif ($filter === 'status') {
                $query->where('status', 'like', "$keyword%");
            }
        }

        $patients_invoices = $query->orderBy('id', 'asc')->paginate(12);

        $html = view('Backend.admin.patientsinvoices.invoices.search', compact('patients_invoices'))->render();

        return response()->json([
            'html' => $html,
            'count' => $patients_invoices->count(),
            'pagination' => $patients_invoices->links('pagination::bootstrap-4')->toHtml(),
            'searching' => $keyword ? true : false,
        ]);
    }






    public function detailsPatientInvoice($id){
        $patient_invoice = PatientInvoice::where('id' , $id)->first();
        $clinic = ClinicInfo::first();
        return view('Backend.admin.patientsinvoices.invoices.details' , compact('patient_invoice' , 'clinic'));
    }





    public function editPatientInvoice($id){
        $patients = Patient::all();
        $patient_invoice = PatientInvoice::where('id' , $id)->first();
        return view('Backend.admin.patientsinvoices.invoices.edit' , compact('patients' , 'patient_invoice'));
    }


    public function updatePatientInvoice(Request $request , $id){
        $patient_invoice = PatientInvoice::findOrFail($id);

        $exists = PatientInvoice::where('id', '!=', $id)
            ->where('appointment_id', $request->appointment_id)->exists();

        if ($exists) {
            return response()->json(['data' => 0]);
        }

        // $oldData = json_encode([
        //     'appointment_id' => $patientInvoice->appointment_id,
        //     'total_amount'   => $patientInvoice->total_amount,
        //     'discount'       => $patientInvoice->discount,
        //     'final_amount'   => $patientInvoice->final_amount,
        //     'notes'          => $patientInvoice->notes,
        // ]);

        $patient_invoice->update([
            'appointment_id' => $request->appointment_id,
            'discount'       => $request->discount,
            'notes'          => $request->notes,
        ]);

        $appointment = Appointment::findOrFail($request->appointment_id);
        $appointment->update([
            'patient_id' => $request->patient_id,
        ]);

        $patient_invoice->refresh();

        // $newData = json_encode([
        //     'appointment_id' => $patientInvoice->appointment_id,
        //     'total_amount'   => $patientInvoice->total_amount,
        //     'discount'       => $patientInvoice->discount,
        //     'final_amount'   => $patientInvoice->final_amount,
        //     'notes'          => $patientInvoice->notes,
        // ]);

        // ActivityLog::create([
        //     'user_id' => auth()->id(),
        //     'action_type' => 'Edit',
        //     'module' => 'Patient Invoices',
        //     'description' => 'The patient invoice with ID '. $id . ' has been Edited by the admin',
        //     'old_data' => $oldData,
        //     'new_data'    => $newData,
        //     'ip_address' => $request->ip(),
        // ]);

        return response()->json(['data' => 1]);
    }





    public function deletePatientInvoice(Request $request , $id){
        $patient_invoice = PatientInvoice::findOrFail($id);
        // $oldData = json_encode([
        //     'appointment_id' => $patientInvoice->appointment_id,
        //     'patient_id'     => $patientInvoice->patient_id,
        //     'total_amount'   => $patientInvoice->total_amount,
        //     'discount'       => $patientInvoice->discount,
        //     'final_amount'   => $patientInvoice->final_amount,
        //     'status'         => $patientInvoice->status,
        //     'notes'          => $patientInvoice->notes,
        // ]);

        $patient_invoice->items->delete();
        $patient_invoice->delete();

        // ActivityLog::create([
        //     'user_id' => auth()->id(),
        //     'action_type' => 'Delete',
        //     'module' => 'Patient Invoices',
        //     'description' => 'The patient invoice with ID '. $id . ' has been deleted by the admin',
        //     'old_data' => $oldData,
        //     'new_data'    => json_encode(['message' => 'Invoice deleted']),
        //     'ip_address' => $request->ip(),
        // ]);
        return response()->json(['success' => true]);
    }
}
