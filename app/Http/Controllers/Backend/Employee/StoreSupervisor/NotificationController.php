<?php

namespace App\Http\Controllers\Backend\Employee\StoreSupervisor;

use Illuminate\Http\Request;
use App\Models\MedicationRequest;
use App\Http\Controllers\Controller;

class NotificationController extends Controller{

    public function markRequestAsRead($id){
        $notification = auth()->user()->notifications()->where('data->request_id', $id)->firstOrFail();

        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }

        return redirect()->route('request_description', $notification->data['request_id']);
    }
}
