<?php

namespace App\Http\Controllers;

use App\Models\MembershipApplication;
use App\Models\User;
use App\Models\Loan;
use App\Models\Payment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin-views.admin-dashboard');

    }

    public function allUsers(){
        $users = User::with('member.membershipApplication')->get();
        return view('admin-views.admin-all-accounts', compact('users'));
    }


    public function showMembers(){
        $memberUsers = User::with('member.units.campuses')->where('user_type', 'member')->get();
        return view('admin-views.admin-members', compact('memberUsers'));
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

}

