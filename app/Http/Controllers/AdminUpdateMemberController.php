<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Unit;
use Illuminate\Http\Request;

class AdminUpdateMemberController extends Controller
{
    public function show($member_id){
        $member = Member::where('id',$member_id)->with('user')->first();
    
        $units = Unit::all();
        return view('admin-views.admin-update-member.admin-update-member', compact('units','member'));
    }

    public function update(Request $request, $member_id){

        $formFields = $request->validate([
            'unit_id'=> 'required', 
            'firstname'=> 'required',
            'lastname'=> 'required',
            
            'middlename'=> 'nullable',
            
            'contact_num'=> 'required',

            'address'=> 'required',
            'date_of_birth'=> 'required',
            'tin_num'=> 'required',
            'position'=> 'nullable',

            'employee_num'=> 'nullable',
            'bu_appointment_date'=> 'nullable',
            'sex'=> 'required',
            'monthly_salary'=> 'required',
            'appointment_status'=> 'required',
        ]);

        $member = Member::findOrFail($member_id);
        $member->update($formFields);
        
        if($formFields['middlename'] != null){
            $member->middle_initial = ucfirst($formFields['middlename'][0]);
            $member->contact_num = '+63'.$formFields['contact_num'];
            $member->save();
        }

        return back()->with('passed', 'Member Details Successfully Updated!');
    }
}
