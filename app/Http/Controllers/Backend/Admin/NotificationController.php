<?php

namespace App\Http\Controllers\Backend\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller{

    public function markAsRead($id){
        $notification = auth()->user()->notifications()->findOrFail($id);

        if ($notification->read_at === null) {
            $notification->markAsRead();
        }


        return redirect()->route('description_medication', $notification->data['medication_id']);
    }

}
