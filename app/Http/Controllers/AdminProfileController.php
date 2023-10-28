<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    public function show(){
        return view ('admin-views.admin-profile.admin-profile');
    }

    public function update(){
        return view ('admin-views.admin-profile.admin-update-profile');
    }

    public function saveUpdate(Request $request, $member_id){
        $formFields = $request->validate([
            'employee_num'=> 'nullable|numeric',
            'tin_num'=> 'required|numeric',
            'address'=> 'required',
            'date_of_birth'=> 'required',
            'bu_appointment_date'=> 'required',
            'sex'=> 'required',
            'contact_num'=> 'required|numeric',
        ]);
        
        $member = Member::findOrFail($member_id);

        $member->employee_num = $formFields['employee_num'];
        $member->tin_num = $formFields['tin_num'];
        $member->address = $formFields['address'];
        $member->date_of_birth = $formFields['date_of_birth'];
        $member->bu_appointment_date = $formFields['bu_appointment_date'];
        $member->sex = $formFields['sex'];
        $member->contact_num = $formFields['contact_num'];
        $member->save();

        return back()->with('passed', 'Profile Updated!');
        // return view('admin-views.admin-profile.admin-profile')->with('passed', 'Profile Updated!');

    }
}
