<?php

namespace App\Http\Controllers;

use App\Models\MembershipApplication;
use App\Models\User;
use App\Models\Loan;
use App\Models\Member;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin-views.admin-dashboard');

    }

    public function allUsers(){
        $users = User::with('member.membershipApplication')->get();
        return view('admin-views.admin-members.admin-all-accounts', compact('users'));
    }


    public function showMembers(){
        $memberUsers = User::with('member.units.campuses')->where('user_type', 'member')->get();
        return view('admin-views.admin-members.admin-members', compact('memberUsers'));
    }


    public function memberLedger(){

        return view('admin-views.admin-ledger');
    }

    public function showRemittance(){
        $payments = Payment::all();
        return view('admin-views.admin-remittance',['payments' => $payments]);
    }

    public function addPaymentRemittance(Request $request){
        $data = $request->validate([
            'or_number' => 'required',
            'payment_date' => 'required|date',
            'loan_id' => 'required',
            'principal' => 'required|numeric',
            'interest' => 'required|numeric',
        ]);

        $existingPayment = Payment::where('or_number', $data['or_number'])->first();
        if ($existingPayment) {
            return redirect()->back()->with('error', 'Duplicate OR Number. Please use a different one.');
        }

        $loan = Loan::find($data['loan_id']);
        if (!$loan) {
            return redirect()->back()->with('error', 'Loan not found.');
        }

        $memberId = $loan->member_id;
        $data['member_id'] = $memberId;
        Payment::create($data);

        return redirect()->route('admin.remittance')->with('success', 'Payment saved successfully.');
    }

    public function allowAdditional($id){

        $member = Member::findOrFail($id);

        if($member->additional_loan == null){
            return back()->with('additional_error','This user is already legible to apply for additional loan');
        }else{
            $member->additional_loan = null;
            $member->save();
            return back()->with('additional_success','Member allowed to apply for additional loan');
        }
    }

    public function notAllowAdditional($id){
        
        $member = Member::findOrFail($id);

        if($member->additional_loan != null){
            return back()->with('additional_error','This user is already not allowed to apply for additional loan');
        }else{
            $member->additional_loan = 1;
            $member->save();
            return back()->with('additional_success','Member is now not legible to apply for additional loan');
        }
    }


} //LAST TAG
