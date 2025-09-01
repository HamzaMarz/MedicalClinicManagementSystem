<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\Pharmacy;
use App\Models\Medication;
use Illuminate\Http\Request;
use App\Models\MedicineStock;
use App\Models\MedicationPharmacy;
use App\Http\Controllers\Controller;

class PharmacyController extends Controller{

    public function viewPharmacyInventory(){
        $medicationPharmacies = MedicationPharmacy::paginate(10);
        return view('Backend.admin.pharmacy.viewPharmacyInventory' , compact('medicationPharmacies'));
    }




    public function searchPharmacyInventory(Request $request){
        $keyword = trim((string) $request->input('keyword', ''));
        $filter  = $request->input('filter', '');

        $medications = MedicationPharmacy::with('medication');

        if ($keyword !== '') {
            switch ($filter) {
                case 'name':
                    $medications->whereHas('medication', function ($q) use ($keyword) {
                        $q->where('name', 'like', "{$keyword}%");
                    });
                    break;

                case 'quantity':
                    $medications->where('quantity', 'like', "{$keyword}%");
                    break;

                case 'status':
                    if (strtolower($keyword) === 'valid') {
                        $medications->whereHas('medication', function ($q) {
                            $q->whereDate('expiry_date', '>=', now()->toDateString());
                        });
                    } elseif (strtolower($keyword) === 'expired') {
                        $medications->whereHas('medication', function ($q) {
                            $q->whereDate('expiry_date', '<', now()->toDateString());
                        });
                    }
                    break;
            }
        }

        $medications = $medications->orderBy('id')->paginate(12);

        $view       = view('Backend.admin.pharmacy.searchPharmacyInventory', compact('medications'))->render();
        $pagination = $medications->total() > 12 ? $medications->links('pagination::bootstrap-4')->render() : '';

        return response()->json([
            'html'       => $view,
            'pagination' => $pagination,
            'count'      => $medications->total(),
            'searching'  => $keyword !== '',
        ]);
    }







    // احذف لما تتأكد
    // public function storeMedicationToPharmacy(Request $request){
    //     $name     = $request->name;
    //     $quantity = (int) $request->quantity;

    //     $medicineStock = MedicineStock::whereHas('medication', function ($q) use ($name) {
    //         $q->where('name', $name);
    //     })->first();

    //     if (!$medicineStock) {
    //         return response()->json(['data' => 0]);   // الدواء غير موجود

    //     }


    //     if ($medicineStock->remaining_quantity  < $quantity) {
    //         return response()->json(['data' => 1]);   // الكمية غير متوفرة
    //     }

    //     $medicineStock->remaining_quantity -= $quantity;
    //     $medicineStock->save();


    //     $pharmacyMed = MedicationPharmacy::firstOrCreate([
    //         'medication_id' => $medicineStock->medication_id,
    //         'pharmacy_id' => 1],
    //         ['quantity' => 0]
    //     );

    //     $pharmacyMed->quantity += $quantity;
    //     $pharmacyMed->save();

    //     return response()->json(['data' => 2]);
    // }






    // public function pharmacyView(){
    //     $pharmacy = Pharmacy::first();
    //     return view('Backend.admin.pharmacy.view' , compact('pharmacy'));
    // }
}
