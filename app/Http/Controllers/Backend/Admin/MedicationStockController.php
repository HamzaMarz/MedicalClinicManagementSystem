<?php

namespace App\Http\Controllers\Backend\Admin;

use Illuminate\Http\Request;
use App\Models\MedicineStock;
use App\Http\Controllers\Controller;

class MedicationStockController extends Controller{

    public function viewStock(){
        $medicineStock = MedicineStock::paginate(10);
        return view('Backend.admin.stock.view' , compact('medicineStock'));
    }
}
