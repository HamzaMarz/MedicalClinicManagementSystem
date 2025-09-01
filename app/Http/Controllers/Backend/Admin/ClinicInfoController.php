<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Models\ClinicInfo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ClinicInfoController extends Controller{

    public function clinicprofile(){
        $clinic = ClinicInfo::firstOrFail();
        return view('Backend.admin.clinic.profile', compact('clinic'));
    }

    public function editClinicProfile(){
        $clinic = ClinicInfo::firstOrFail();
        return view('Backend.admin.clinic.edit', compact('clinic'));
    }

    public function updateClinicProfile(Request $request){
        $clinic = ClinicInfo::firstOrFail();

        $imagePath = $clinic->image;
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('assets/img/clinic'), $imageName);
            $imagePath = 'assets/img/clinic/' . $imageName;
        }

        $clinic->update([
            'name' => $request->name ,
            'email' => $request->email ,
            'phone' => $request->phone,
            'location' => $request->location,
            'logo' => $imagePath,
            'work_days' => $request->work_days,
            'work_start' => $request->work_start,
            'work_end' => $request->work_end,
            'description' => $request->description,
        ]);
        return response()->json(['data' => 1]);
    }
}
