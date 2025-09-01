<?php

namespace App\Http\Controllers\Backend\Employee\StoreSupervisor;

use Illuminate\Http\Request;
use App\Models\MedicationRequest;
use App\Http\Controllers\Controller;

class NotificationController extends Controller{

    public function markAsRead($id){
        $notification = auth()->user()->notifications()->findOrFail($id);
        if ($notification->read_at === null) {
            $notification->markAsRead();
        }

        $request = MedicationRequest::where('medication_id', $notification->data['medication_id'])->first();

        return redirect()->route('request_description', $request->id);
    }
}
