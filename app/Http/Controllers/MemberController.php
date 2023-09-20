<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\User;
use App\Models\Loan;
use App\Models\Campus;
use App\Models\Member;
use App\Models\CoBorrower;
use App\Models\Payment;
use App\Models\LoanApplicationState;
use App\Models\LoanApplicationStatus;
use App\Models\Witness;
use App\Rules\EmailDomain;
use App\Models\Beneficiary;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\MembershipApplication;
use App\Models\BeneficiaryRelationship;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function showMemberDash(){
        $user = Auth::user();
        $loans = Loan::where('member_id', $user->member->id)->where('is_active', 1)->get();

        //If no loans or all loans have been paid, set principal amount to 0.00
        if ($loans->isEmpty() || $loans->every(fn($loan) => $loan->principal_amount == 0.00)) {
            $principalAmount = 0.00;
        } else {
            $principalAmount = $loans->sum('principal_amount');
        }

        $mplLoans = $loans->where('loan_type_id', 1)->first();
        $hslLoans = $loans->where('loan_type_id', 2)->first();

        //get pending loan -> accepted by the co-borrower and inactive loan
        $inActiveLoan = CoBorrower::with(
            'member.units.campuses',
            'loan.member.units.campuses',
            'loan.loanApplicationStatus.loanApplicationState',
            'loan.loanType'
        )
        ->where('accept_request', '1') // Get loans accepted by coBorrower
        ->whereHas('loan', function ($query) {
            $query->where(function ($query) {
                $query->where('member_id', Auth::user()->member->id)
                      ->orWhereNull('member_id')
                      ->orWhere('member_id', 0);
            })
            ->where(function ($query) {
                $query->where('is_active', 0)
                      ->orWhereNull('is_active')
                      ->orWhere('is_active', 0);
            });
        })->first();

        //get transactions -> Loan application and payment
        $payments = Payment::where('member_id', $user->member->id)->get();
        $hasPayments = !$payments->isEmpty();

        return view('member-views.member-dashboard', [
            'principalAmount' => $principalAmount,
            'mplLoans' => $mplLoans,
            'hslLoans' => $hslLoans,
            'loans' => $loans,
            'inActiveLoan' => $inActiveLoan,
            'payments' => $payments,
            'hasPayments' => $hasPayments,
        ]);
    }

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

        return redirect('/member/membership-form/edit-download')->with('message', 'Membership Saved');
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

    //SHOW form view for editing membership
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


        return redirect('/member/membership-form/edit-download')->with('message', 'Membership Form Created');

    }

    public function viewProfile(){
        $id = Auth::user()->member->id;
        $user = User::find($id);
        $member = Member::where('user_id', $id)->first();
        // dd($member);
        $unit = Unit::where('id', $member->unit_id)->first();

        $campus = Campus::where('id', $unit->campus_id)->first();
        $units = Unit::all();
        $campuses = Campus::all();

        return view('member-views.member-profile.profile', [
            'user' => $user,
            'member' => $member,
            'unit'  => $unit,
            'campus' => $campus,
            'units' => $units,
            'campuses' => $campuses,
        ]);
    }

    public function profileUpdate(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'unit_id' => 'required',
            'position' => 'required',
            // IGNORE THE EMAIL ASSOCIATED WITH THE LOGGED IN USER
            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
                Rule::unique('users')->ignore(Auth::user()->id),
                new EmailDomain('bicol-u.edu.ph')
            ],
            'contact_num' => 'required',
            'address' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return redirect('/member/profile/'.Auth::user()->id)->withErrors($errors);
        }

        $user = User::with('member')->find($id);

        if ($user->email != $request->email) {
            $user->email = $request->input('email');
            // Reset Email to verify it again
            $user->email_verified_at = null;
            $user->sendEmailVerificationNotification();
        }

        $user->save();

        $user->member->unit_id = $request->unit_id;
        $user->member->position = $request->position;
        $user->member->contact_num = $request->contact_num;
        $user->member->address = $request->address;

        $user->member->save();

        return redirect('/member/profile/'.Auth::user()->id)->with('message', 'Profile Saved!');
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
//    public function applyLoan(){
//        return view('/member-views/apply-loan');
//     }
}
