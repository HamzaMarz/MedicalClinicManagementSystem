<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Models\MedicineStock;
use App\Http\Controllers\Controller;
use App\Models\Medication;

class MedicationStockController extends Controller{

    public function viewStockInventory(){
        $medicineStock = MedicineStock::paginate(12);
        return view('Backend.admin.stock.view' , compact('medicineStock'));
    }




    public function stockInventoryAdd(){
        $medication = Medication::all();
        return view('Backend.admin.stock.addMedication' , compact('medication'));
    }


    public function stockInventoryStore(){

    }
}
