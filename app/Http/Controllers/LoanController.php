<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function show(){
        $raw_loans = Loan::where('member_id', Auth::user()->member->id)
            ->with('loanType' , 'payment','amortization', 'loanApplicationStatus')
            ->get();

        $loans = [];
        foreach($raw_loans as $raw_loan){
            $loanStatus = [];
            foreach($raw_loan->loanApplicationStatus as $status){
                array_push($loanStatus, $status->loan_application_state_id);
            }
            if(in_array(5,$loanStatus)){
                array_push($loans, $raw_loan);
            }
        }


        return view('member-views.your-loans.member-loans', compact('loans'));
    }

    public function displayLoanDetails($id){
        $loan = Loan::where('id', $id)->first();
        $payments = $loan->payment;

        return view('member-views.your-loans.member-loan-details',
            compact(
                'loan',
                'payments'
            ));
    }
}
