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
        $loanIds = Loan::all()->where('is_active', 1)->pluck('id')->toArray();

        return view('admin-views.admin-loan-remittance.admin-remittance', [
            'payments' => $payments,
            'loanIds' => $loanIds,
        ]);
    }

    public function addPaymentRemittance(Request $request){

        $data = $request->validate([
            'or_number' => 'required',
            'payment_date' => 'required|date',
            'loan_id' => 'required',
            'principal' => 'nullable|numeric',
            'interest' => 'numeric',
        ]);

         // Replace null 'principal' with 0
        $data['principal'] = $data['principal'] ?? 0;

        //The OR Number must be unique
        $existingPayment = Payment::where('or_number', $data['or_number'])->first();
        if ($existingPayment) {
            return redirect()->back()->with('error', 'Duplicate OR Number. Please use a different one.');
        }

        // Get the loan based on the loan_id
        $loan = Loan::find($data['loan_id']);
        if (!$loan) {
            // if Loan not found
            return redirect()->back()->with('error', 'Loan not found.');
        }

        //Calculate the total loan payment made using the loan_id and the principal and interest
        $totalLoanPayment = Payment::where('loan_id', $data['loan_id'])->sum('principal') + Payment::where('loan_id', $data['loan_id'])->sum('interest');
        $loanBalance = ($loan->principal_amount + $loan->interest) - $totalLoanPayment;

        // Check if the payment exceeds the loan balance
        if($loanBalance - ($data['principal'] + $data['interest']) < 0){
            return redirect()->back()->with('error', 'Payment exceeds loan balance.');
        }

        // If the payment is equal to the loan balance, set the loan to non-performing
        if($loanBalance - ($data['principal'] + $data['interest']) == 0){
            $loan->is_active = 2;
            $loan->save();
        }

        $memberId = $loan->member_id;
        $data['member_id'] = $memberId;
        //save payment
        Payment::create($data);

        return redirect()->route('admin.remittance')->with('success', 'Payment saved successfully.');
    }

}

