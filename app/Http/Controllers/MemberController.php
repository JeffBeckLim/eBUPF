<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function membershipForm(){
        return view('member-views.membership_form');
    }

    public function createMembership(Request $request, Member $member){

        //Ensure that user is logged in
        if($member->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        $formFields = $request->validate([
          
            // 'campus_id'=> 'required', // naka comment out muna - - need pa seeders
            // 'unit_id'=> 'required', // naka comment out muna - - need pa seederss
            'firstname'=> 'required',
            'lastname'=> 'required',
            'agree_to_terms'=> 'required',
            'middle_initial'=> 'required',
            // 'contact_num'=> 'required',
            'address'=> 'required',
            'date_of_birth'=> 'required',
            'tin_num'=> 'required',
            'position'=> 'required',
            // 'created_at'
            'employee_num'=> 'required',
            'bu_appointment_date'=> 'required',
    
            'place_of_birth'=> 'required',
            'civil_status'=> 'required',
            // 'spouse'=> 'required',
            'sex'=> 'required',
            'monthly_salary'=> 'required',  
            'monthly_contribution'=> 'required',  
            'appointment_status'=> 'required', 
            // 'profile_picture'=> 'required',
    
            'agree_to_certify'=> 'required',
            'agree_to_authorize'=> 'required',
            
            // 'beneficiary0'=> 'required',
            // 'beneficiary_birthday0'=> 'required',
            // 'beneficiary_relationship0'=> 'required',
        ]);
        // dd($formFields);
        // for profile pic - basehan ng code
        // if($request->hasFile('logo')) {
        //     $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        // }

        $member->update($formFields);
            
        return redirect('/')->with('message', 'Membership Created');

    }   
}
