<?php

namespace App\Http\Controllers\Backend\Employee\StoreSupervisor;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\MedicineStock;
use App\Models\MedicationRequest;
use App\Models\MedicationPharmacy;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Notifications\MedicationRequestApprovedNotification;

class RequestController extends Controller{

    public function viewRequests(){
        $requests = MedicationRequest::orderBy('id', 'desc')->paginate(10);
        return view ('Backend.employees.store_supervisors.requests.view' , compact('requests'));
    }




    // المشرف يوافق
    public function approve($id){
        $request = MedicationRequest::findOrFail($id);

        // ما ينفعش تغير حالة غير pending
        if ($request->status !== 'pending') {
            return response()->json(['data' => -1]); // الطلب مش مسموح يتغير
        }

        $medicineStock = MedicineStock::where('medication_id', $request->medication_id)->first();

        if (!$medicineStock) {
            return response()->json(['data' => 0]); // الدواء مش موجود بالمخزن
        }

        $quantity = $request->requested_quantity;
        if ($medicineStock->remaining_quantity < $quantity) {
            return response()->json(['data' => 1]); // الكمية غير متوفرة
        }

        // 3. خصم الكمية من المخزن
        $medicineStock->remaining_quantity -= $quantity;
        $medicineStock->save();

        // 4. إضافة الكمية للصيدلية
        $pharmacyMed = MedicationPharmacy::firstOrCreate(
            [
                'medication_id' => $medicineStock->medication_id,
                'pharmacy_id'   => 1,
            ],
            [
                'quantity' => 0
            ]
        );

        $pharmacyMed->quantity += $quantity;
        $pharmacyMed->save();

        // تحديث حالة الطلب وربطه بالمشرف
        $request->update([
            'status'        => 'approved',
            'supervisor_id' => auth()->id(),
        ]);

        // هذاالكود يجعل الإشعارات الغير مقروءة تصبح مقروءة عند تنفيذ الطلب
        DB::table('notifications')
        ->where('type', 'App\Notifications\NewMedicationRequestNotification')
        ->where('notifiable_type', 'App\Models\User')
        ->whereRaw("JSON_EXTRACT(data, '$.medication_id') = ?", [$request->medication_id])
        ->whereNull('read_at')
        ->update(['read_at' => now()]);


        $admin = User::role('admin')->first(); // إرسال شعار النجاح عند قبول الموظف الطلب
        if ($admin) {
            $admin->notify(new MedicationRequestApprovedNotification($request, auth()->user()));
        }

        return response()->json(['data' => 2]); // العملية نجحت
    }





    public function viewReject($id){
        $request = MedicationRequest::findOrFail($id);
        return view('Backend.employees.store_supervisors.requests.rejection', compact('request'));
    }

    // المشرف يرفض
    public function reject(Request $request, $id){
        $req = MedicationRequest::findOrFail($id);
        if ($req->status !== 'pending') {
            return response()->json(['success' => false, 'message' => 'This request has already been processed.']);
        }

        $req->update([
            'status' => 'rejected',
            'note' => $request->note,
            'supervisor_id' => auth()->id(),
        ]);

        return response()->json(['success' => true]);
    }





    public function requestDescription($id){
        $request = MedicationRequest::where('id' , $id)->first();
        return view ('Backend.employees.store_supervisors.requests.description' , compact('request'));
    }
}
