<?php

namespace App\Http\Controllers\Backend\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotificationController extends Controller{

    public function markExpiredAsRead($id){
        $notification = auth()->user()->notifications()
        ->where('data->medication_id', $id)
        ->firstOrFail();

        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }

        return redirect()->route('description_medication', $notification->data['medication_id']);
    }





    public function markDescriptionAsRead($id){
        $notification = auth()->user()->notifications()->where('data->request_id', $id)->firstOrFail();

        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }

        return redirect()->route('admin_request_description', $notification->data['request_id']);
    }



    

}
