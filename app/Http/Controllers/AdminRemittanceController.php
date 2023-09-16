<?php

namespace App\Http\Controllers;

use App\Models\MembershipApplication;
use App\Models\User;
use App\Models\Loan;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Form;

class AdminRemittanceController extends Controller
{
    public function showRemittance(){
        $payments = Payment::all();
        $loanIds = Loan::all()->pluck('id')->toArray();

        return view('admin-views.admin-remittance', [
            'payments' => $payments,
            'loanIds' => $loanIds, // Pass the loan IDs to the view
        ]);
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

