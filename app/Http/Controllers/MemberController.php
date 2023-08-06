<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\User;
use App\Models\Campus;
use App\Models\Member;
use App\Models\Beneficiary;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\MembershipApplication;
use App\Models\BeneficiaryRelationship;

class MemberController extends Controller
{
    public function checkMembershipApplication($member_id){
        // dd($member_id);
         $member = MembershipApplication::find($member_id);
         if(!$member){
            return redirect('/member/membership-form');
         }
         else{
            return redirect('/member/membership-form/edit');
         }
    }

    //show membership form
    public function membershipForm(){
        //gets all the units along with the related campus
        $units = Unit::with('campuses')->get();
        
        //return view with units variable.
        $relationship_types = BeneficiaryRelationship::all();

        return view('member-views.membership-form.membership_form', compact('units', 'relationship_types'));
    }

    //return form view for editing membership
    public function membershipFormEdit(){
        return view('member-views.membership-form-edit.membership_form');
    }
    public function createMembership(Request $request, Member $member){
        // dd($request);
        //Ensure that user is logged in
        if($member->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        $formFields = $request->validate([
          
            // 'campus_id'=> 'required', // naka comment out muna - - need pa seeders
            'unit_id'=> 'required', // naka comment out muna - - need pa seederss
            'firstname'=> 'required',
            'lastname'=> 'required',
            'agree_to_terms'=> 'required',
            'middle_initial'=> 'required',

            'contact_num'=> 'nullable',

            'address'=> 'required',
            'date_of_birth'=> 'required',
            'tin_num'=> 'required',
            'position'=> 'required',
            
            'employee_num'=> 'required',
            'bu_appointment_date'=> 'required',
    
            'place_of_birth'=> 'required',
            'civil_status'=> 'required',

            'spouse'=> 'nullable',
            
            'sex'=> 'required',
            'monthly_salary'=> 'required',  
            'monthly_contribution'=> 'required',  
            'appointment_status'=> 'required', 
            // 'profile_picture'=> 'required',
    
            'agree_to_certify'=> 'required',
            'agree_to_authorize'=> 'required',
            
            'beneficiary0'=> 'required',
            'beneficiary_birthday0'=> 'required',
            'beneficiary_relationship0'=> 'required',
        ]);

        // for profile pic - basehan ng code
        // if($request->hasFile('logo')) {
        //     $formFields['logo'] = $request->file('logo')->store('logos', 'public');

        MembershipApplication::create([
            'member_id' => $member->id,
            'ref_number' => Str::uuid()->toString(),
            'status' => 0,
        ]);

        $member->update($formFields);
        
        Beneficiary::create([
            'member_id' => $member->id,
            'beneficiary_name' => $formFields['beneficiary0'],
            'birthday' => $formFields['beneficiary_birthday0'],
            'relationship' => $formFields['beneficiary_relationship0'],
        ]);
        if($request->beneficiary1){
            Beneficiary::create([
                'member_id' => $member->id,
                'beneficiary_name' => $request['beneficiary1'],
                'birthday' => $request['beneficiary_birthday1'],
                'relationship' => $request['beneficiary_relationship1'],
            ]);
        }
        if($request->beneficiary2){
            Beneficiary::create([
                'member_id' => $member->id,
                'beneficiary_name' => $request['beneficiary2'],
                'birthday' => $request['beneficiary_birthday2'],
                'relationship' => $request['beneficiary_relationship2'],
            ]);
        }
        if($request->beneficiary3){
            Beneficiary::create([
                'member_id' => $member->id,
                'beneficiary_name' => $request['beneficiary3'],
                'birthday' => $request['beneficiary_birthday3'],
                'relationship' => $request['beneficiary_relationship3s'],
            ]);
        }
        if($request->beneficiary4){
            Beneficiary::create([
                'member_id' => $member->id,
                'beneficiary_name' => $request['beneficiary4'],
                'birthday' => $request['beneficiary_birthday4'],
                'relationship' => $request['beneficiary_relationship4'],
            ]);
        }
       
            
        return redirect('/')->with('message', 'Membership Created');

    }   
}
