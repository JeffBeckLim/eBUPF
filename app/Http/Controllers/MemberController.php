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
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function updateMembership(Request $request, Member $member){
       $beneficiaries=Beneficiary::where('member_id', Auth::user()->id)->orderBy('id', 'asc')->get();

       if($member->user_id != auth()->id()) {
        abort(403, 'Unauthorized Action');
        }
        $formFields = $request->validate([

            // 'campus_id'=> 'required', // naka comment out muna - - need pa seeders
            'unit_id'=> 'required', // naka comment out muna - - need pa seederss
            'firstname'=> 'required',
            'lastname'=> 'required',

            'agree_to_terms'=> 'nullable',

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

            'profile_picture'=> 'nullable|image|mimes:jpeg,png|max:2048',

            'agree_to_certify'=> 'required',
            'agree_to_authorize'=> 'required',

            'beneficiary0'=> 'required',
            'beneficiary_birthday0'=> 'required',
            'beneficiary_relationship0'=> 'required',
        ]);
        // for profile pic validation
        if($request->hasFile('profile_picture')) {
            $formFields['profile_picture'] = $request->file('profile_picture')->store('profile_picture', 'public');
        }

    
       for ($i = 0; $i < 5; $i++) {
        if (isset($beneficiaries[$i])) {
            $beneficiary = $beneficiaries[$i];
        } else if ($request->filled("beneficiary{$i}")) {
            $beneficiary = new Beneficiary();
            $beneficiary->member_id = $member->id;
        } 
        else {
            continue; // Skip iteration if no beneficiary data present
        }
        if($request->input("beneficiary{$i}")){
            $beneficiary->beneficiary_name = $request->input("beneficiary{$i}");
            $beneficiary->birthday = $request->input("beneficiary_birthday{$i}");
            $beneficiary->relationship = $request->input("beneficiary_relationship{$i}");
            $beneficiary->save();
        }
        else{
            return redirect()->back()->with('error', 'Please provide names for all beneficiaries. If not, the other fields will be cleared.');
        }
        }

        $member->update($formFields);
        return redirect('/member/membership-form/edit-download')->with('message', 'Membership Updated');
    }




    public function membershipFormEditDownload(){
        return view('member-views.membership-form.membership-download-edit');
    }


    //show membership form
    public function membershipForm(){
        //gets all the units along with the related campus
        $units = Unit::with('campuses')->get();

        $units = collect($units)->sortBy('unit_code')->values()->all();


        //return view with units variable.
        $relationship_types = BeneficiaryRelationship::all();

        return view('member-views.membership-form.membership_form', compact('units', 'relationship_types'));
    }

    //return form view for editing membership
    public function membershipFormEdit(){
        //gets all the units along with the related campus
        $units = Unit::with('campuses')->get();

        //return view with units variable.
        $relationship_types = BeneficiaryRelationship::all();

        $beneficiaries=Beneficiary::where('member_id', Auth::user()->id)->orderBy('id', 'asc')->get();

        return view('member-views.membership-form-edit.membership_form', compact('units', 'relationship_types', 'beneficiaries'));
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

            'agree_to_terms'=> 'nullable',

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

            'profile_picture'=> 'nullable|image|mimes:jpeg,png|max:2048',

            'agree_to_certify'=> 'required',
            'agree_to_authorize'=> 'required',

            'beneficiary0'=> 'required',
            'beneficiary_birthday0'=> 'required',
            'beneficiary_relationship0'=> 'required',
        ]);
        // dd($formFields);
        // for profile pic validation
        if($request->hasFile('profile_picture')) {
            $formFields['profile_picture'] = $request->file('profile_picture')->store('profile_picture', 'public');
        }

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
                'relationship' => $request['beneficiary_relationship3'],
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


        return redirect('/member/membership-form/edit-download')->with('message', 'Membership Created');

    }

    public function viewProfile($id){
        $user = User::find($id);
        $member = Member::where('user_id', $id)->first();
        $unit = Unit::where('id', $member->unit_id)->first();
        $campus = Campus::where('id', $unit->campus_id)->first();

        return view('member-views.profile', [
            'user' => $user,
            'member' => $member,
            'unit'  => $unit,
            'campus' => $campus,
        ]);
    }

    public function checkMembershipApplication($member_id){
         $member = MembershipApplication::where('member_id', $member_id)->get();
         if(count($member)===0){
            return redirect('/member/membership-form');
         }
         else{
            return redirect('/member/membership-form/edit-download');
         }
    }

}
