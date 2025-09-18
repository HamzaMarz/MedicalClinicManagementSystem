<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Patient;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PatientInvoicePayment;
use App\Models\PatientInvoicePaymentDetail;

class PatientInvoicePaymentController extends Controller{

    public function viewPatientsInvoicesPayments(){
        $payments = PatientInvoicePayment::orderBy('id', 'asc')->paginate(12);
        return view('Backend.admin.patientsinvoices.payment.view' , compact('payments'));
    }





    public function detailsPatientInvoicePayment($id){
        $payment = PatientInvoicePayment::findOrFail($id);
        $payments_details = $payment->patientInvoicePaymentDetails()->orderBy('payment_date', 'asc')->get();

        $finalAmount = $payment->invoice->final_amount ?? 0;
        $totalPaid = $payments_details->sum('amount_paid');

        return view('Backend.admin.patientsinvoices.payment.details.view' , compact('payments_details',
            'finalAmount',
            'totalPaid',
        ));
    }





    public function deletePatientInvoicePayment($id){
        $payment = PatientInvoicePayment::findOrFail($id);
        $payment->patientInvoicePaymentDetails()->delete();
        $payment->delete();
        return response()->json(['success' => true]);
    }







    // Details

    public function editPaymentDetails($id){
        $payment_detail = PatientInvoicePaymentDetail::findOrFail($id);
        return view('Backend.admin.patientsinvoices.payment.details.edit' , compact('payment_detail'));
    }



    public function updatePaymentDetails(Request $request , $id){
        $payment_detail = PatientInvoicePaymentDetail::findOrFail($id);
        $exists = PatientInvoicePaymentDetail::where('id', '!=', $id)
            ->where('amount_paid', $request->amount_paid)
            ->where('payment_method', $request->payment_method)
            ->where('payment_date', $request->payment_date)
            ->exists();

        if ($exists) {
            return response()->json(['data' => 0]);
        }

        $payment_detail->update([
            'amount_paid'     => $request->amount_paid,
            'payment_method'  => $request->payment_method,
            'payment_date'    => $request->payment_date,
            'notes'           => $request->notes,
        ]);

        return response()->json(['data' => 1]);
    }



    public function deletePaymentDetails($id){
        $payment_detail = PatientInvoicePaymentDetail::findOrFail($id);
        $payment_detail->delete();
        return response()->json(['success' => true]);
    }
}
