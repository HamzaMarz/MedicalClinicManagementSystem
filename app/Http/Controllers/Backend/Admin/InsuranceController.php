<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Claim;
use App\Models\Patient;
use Illuminate\Http\Request;
use App\Models\PatientInsurance;
use App\Models\InsuranceProvider;
use App\Http\Controllers\Controller;

class InsuranceController extends Controller{


    //Insurance Provider

    public function addInsuranceProvider(){
        return view('Backend.admin.insurances.add');
    }


    public function storeInsuranceProvider(Request $request){
        $existing_insurance_provider = InsuranceProvider::where('name', $request->name)->orwhere('email', $request->email)->orwhere('phone', $request->phone)->first();
        if($existing_insurance_provider){
            return response()->json(['data' => 0]);
        }else{

            InsuranceProvider::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'representative_name' => $request->representative_name,
                'representative_phone' => $request->representative_phone,
                'status' => $request->status,
            ]);
                return response()->json(['data' => 1]);
        }
    }






    public function viewInsurancesProviders(){
        $insurances_providers = InsuranceProvider::orderBy('id', 'asc')->paginate(12);
        return view('Backend.admin.insurances.view' , compact('insurances_providers'));
    }




    public function searchInsurancesProviders(Request $request){
        $query = InsuranceProvider::query();

        $keyword = $request->input('keyword');
        $filter  = $request->input('filter');

        if (!empty($keyword)) {
            switch ($filter) {
                case 'name':
                    $query->where('name', 'LIKE', "{$keyword}%");
                    break;

                case 'representative_name':
                    $query->where('representative_name', 'LIKE', "{$keyword}%");
                    break;

                case 'status':
                    $query->where('status', 'LIKE', "{$keyword}%");
                    break;
            }
        }

        $insurances_providers = $query->paginate(12);

        return response()->json([
            'html'       => view('Backend.admin.insurances.search', compact('insurances_providers'))->render(),
            'count'      => $insurances_providers->total(),
            'searching'  => $keyword !== '',
            'pagination' => $insurances_providers->links('pagination::bootstrap-4')->render(),
        ]);
    }






    public function detailsInsuranceProvider($id){
        $insurance_provider = InsuranceProvider::findOrFail($id);
        return view('Backend.admin.insurances.details', compact('insurance_provider'));
    }





    public function editInsuranceProvider($id){
        $insurance_provider = InsuranceProvider::findOrFail($id);
        return view('Backend.admin.insurances.edit', compact('insurance_provider'));
    }


    public function updateInsuranceProvider(Request $request , $id){
        $insurance_provider = InsuranceProvider::findOrFail($id);
        $existing_insurance_provider = InsuranceProvider::where('name', $request->name)->orwhere('email', $request->email)->orwhere('phone', $request->phone)->where('id', '!=', $id)->first();
        if($existing_insurance_provider){
            return response()->json(['data' => 0]);
        }else{
            $insurance_provider->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'representative_name' => $request->representative_name,
                'representative_phone' => $request->representative_phone,
                'status' => $request->status,
            ]);
            return response()->json(['data' => 1]);
        }
    }





    public function deleteInsuranceProvider($id){
        $insurance_provider = InsuranceProvider::findOrFail($id);
        $insurance_provider->delete();
        return response()->json(['success' => true]);

    }






    //Patient Insurance

    public function addPatientInsurance(){
        $patients = Patient::all();
        $insurances_providers = InsuranceProvider::all();
        return view('Backend.admin.insurances.patients_insurances.add' , compact('patients' , 'insurances_providers'));
    }


    public function storePatientInsurance(Request $request){
        $existing_patient_insurance = PatientInsurance::where('patient_id', $request->patient_id)
            ->where('provider_id', $request->provider_id)
            ->first();

        if ($existing_patient_insurance) {
            return response()->json(['data' => 0]); // موجود مسبقًا
        } else {

            // توليد رقم تأمين واقعي (مثال: #2025-123456)
            do {
                $insuranceNumber = '#' . date('Y') . '-' . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
            } while (PatientInsurance::where('insurance_number', $insuranceNumber)->exists());

            PatientInsurance::create([
                'patient_id' => $request->patient_id,
                'provider_id' => $request->provider_id,
                'insurance_number' => $insuranceNumber,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'coverage_percentage' => $request->coverage_percentage,
            ]);
                return response()->json(['data' => 1]);
        }
    }






    public function viewPatientsInsurances(){
        $patients_insurances = PatientInsurance::orderBy('id', 'asc')->paginate(12);
        return view('Backend.admin.insurances.patients_insurances.view' , compact('patients_insurances'));
    }




    public function searchPatientsInsurances(Request $request){
        $query = PatientInsurance::with(['patient.user', 'provider']);

        $keyword = $request->input('keyword');
        $filter  = $request->input('filter');

        if (!empty($keyword)) {
            switch ($filter) {
                case 'patient_name':
                    $query->whereHas('patient.user', function ($q) use ($keyword) {
                        $q->where('name', 'LIKE', "{$keyword}%");
                    });
                    break;

                case 'provider_name':
                    $query->whereHas('provider', function ($q) use ($keyword) {
                        $q->where('name', 'LIKE', "{$keyword}%");
                    });
                    break;
            }
        }

        $patients_insurances = $query->paginate(12);

        return response()->json([
            'html'       => view('Backend.admin.insurances.patients_insurances.search', compact('patients_insurances'))->render(),
            'count'      => $patients_insurances->total(),
            'searching'  => $keyword !== '',
            'pagination' => $patients_insurances->links('pagination::bootstrap-4')->render(),
        ]);
    }





    public function editPatientInsurance($id){
        $patient_insurance = PatientInsurance::findOrFail($id);
        $patients = Patient::all();
        $insurances_providers = InsuranceProvider::all();

        return view('Backend.admin.insurances.patients_insurances.edit',
            compact('patient_insurance', 'patients', 'insurances_providers')
        );
    }


    public function updatePatientInsurance(Request $request , $id){
        $patient_insurance = PatientInsurance::findOrFail($id);
        $existing_patient_insurance = PatientInsurance::where('patient_id', $request->patient_id)->where('provider_id', $request->provider_id)->where('id', '!=', $id)->first();
        if($existing_patient_insurance){
            return response()->json(['data' => 0]);
        }else{
            $patient_insurance->update([
                'patient_id' => $request->patient_id,
                'provider_id' => $request->provider_id,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'coverage_percentage' => $request->coverage_percentage,
            ]);
            return response()->json(['data' => 1]);
        }
    }





    public function deleteInsuranceInsurance($id){
        $patient_insurance = PatientInsurance::findOrFail($id);
        $patient_insurance->delete();
        return response()->json(['success' => true]);

    }





    // Cliams

    public function addClaim(){
        // $patients = Patient::all();
        // $insurances_providers = InsuranceProvider::all();
        // return view('Backend.admin.insurances.claims.add' , compact('patients' , 'insurances_providers'));
    }


    public function storeClaim(Request $request){
        // $existing_patient_insurance = PatientInsurance::where('patient_id', $request->patient_id)
        //     ->where('provider_id', $request->provider_id)
        //     ->first();

        // if ($existing_patient_insurance) {
        //     return response()->json(['data' => 0]); // موجود مسبقًا
        // } else {

        //     // توليد رقم تأمين واقعي (مثال: #2025-123456)
        //     do {
        //         $insuranceNumber = '#' . date('Y') . '-' . str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        //     } while (PatientInsurance::where('insurance_number', $insuranceNumber)->exists());

        //     PatientInsurance::create([
        //         'patient_id' => $request->patient_id,
        //         'provider_id' => $request->provider_id,
        //         'insurance_number' => $insuranceNumber,
        //         'start_date' => $request->start_date,
        //         'end_date' => $request->end_date,
        //         'coverage_percentage' => $request->coverage_percentage,
        //     ]);
        //         return response()->json(['data' => 1]);
        // }
    }






    public function viewClaims(){
        // $patients_insurances = PatientInsurance::orderBy('id', 'asc')->paginate(12);
        // return view('Backend.admin.insurances.claims.view' , compact('patients_insurances'));
    }




    public function searchClaims(Request $request){
        // $query = PatientInsurance::with(['patient.user', 'provider']);

        // $keyword = $request->input('keyword');
        // $filter  = $request->input('filter');

        // if (!empty($keyword)) {
        //     switch ($filter) {
        //         case 'patient_name':
        //             $query->whereHas('patient.user', function ($q) use ($keyword) {
        //                 $q->where('name', 'LIKE', "{$keyword}%");
        //             });
        //             break;

        //         case 'provider_name':
        //             $query->whereHas('provider', function ($q) use ($keyword) {
        //                 $q->where('name', 'LIKE', "{$keyword}%");
        //             });
        //             break;
        //     }
        // }

        // $patients_insurances = $query->paginate(12);

        // return response()->json([
        //     'html'       => view('Backend.admin.insurances.claims.search', compact('patients_insurances'))->render(),
        //     'count'      => $patients_insurances->total(),
        //     'searching'  => $keyword !== '',
        //     'pagination' => $patients_insurances->links('pagination::bootstrap-4')->render(),
        // ]);
    }





    public function editClaim($id){
        // $patient_insurance = PatientInsurance::findOrFail($id);
        // $patients = Patient::all();
        // $insurances_providers = InsuranceProvider::all();

        // return view('Backend.admin.insurances.claims.edit',
        //     compact('patient_insurance', 'patients', 'insurances_providers')
        // );
    }


    public function updateClaim(Request $request , $id){
        // $patient_insurance = PatientInsurance::findOrFail($id);
        // $existing_patient_insurance = PatientInsurance::where('patient_id', $request->patient_id)->where('provider_id', $request->provider_id)->where('id', '!=', $id)->first();
        // if($existing_patient_insurance){
        //     return response()->json(['data' => 0]);
        // }else{
        //     $patient_insurance->update([
        //         'patient_id' => $request->patient_id,
        //         'provider_id' => $request->provider_id,
        //         'start_date' => $request->start_date,
        //         'end_date' => $request->end_date,
        //         'coverage_percentage' => $request->coverage_percentage,
        //     ]);
        //     return response()->json(['data' => 1]);
        // }
    }





    public function deleteClaim($id){
        // $cliam = Claim::findOrFail($id);
        // $cliam->delete();
        // return response()->json(['success' => true]);

    }
}
