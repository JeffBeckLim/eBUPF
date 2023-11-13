<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\PenaltyPayment;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function show($loan_status){
       /*  //if loan status is 1, show performing
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
        } */

        $memberID = Auth::user()->member->id;

        // Get all loans of the member with related data
        $loans = Loan::where('member_id', $memberID)
        ->with('loanType', 'payment', 'amortization', 'loanApplicationStatus' , 'penalty')
        ->orderBy('created_at', 'desc') // Sort by created_at in descending order
        ->get();

        $i=0;
        foreach($loans as $loan){
            $loanStatus = [];
            foreach($loan->loanApplicationStatus as $status){
                array_push($loanStatus, $status->loan_application_state_id);
            }
            if(!in_array(5,$loanStatus)){
                unset($loans[$i]);
            }
            $i += 1;
        }
        // dd($loans);

        // Get all payments of the member
        $payments = Payment::where('member_id', $memberID)
            ->get();

        if($loan_status == 1){
            $loans = $loans->filter(function($loan) {
                return $loan->loanApplicationStatus->contains('loan_application_state_id', 5) && $loan->is_active == 1;
            });
        } elseif($loan_status == 2){
            // Filter loans that are considered paid
            $loans = $loans->filter(function($loan) use ($payments){
                // Calculate total payments for the loan
                $totalPayment = 0;
                foreach ($payments as $payment) {
                    if ($payment->loan_id === $loan->id) {
                        $totalPayment += $payment->principal + $payment->interest;
                    }
                }

                // Check if the loan is paid
                $loanIsPaid = $totalPayment >= ($loan->principal_amount + $loan->interest);

                return $loanIsPaid;
            });
        }

        // Calculate total payments per loan for all loans
        foreach ($loans as $loan) {
            $totalPayment = 0;
            foreach ($payments as $payment) {
                if ($payment->loan_id === $loan->id) {
                    $totalPayment += $payment->principal + $payment->interest;
                }
            }
            $loan->totalPayment = $totalPayment;
        }
        /* dd($loans); */
        return view('member-views.your-loans.member-loans', compact('loans', 'loan_status', 'payments'));
    }

    public function displayLoanDetails($id){
        $loan = Loan::where('id', $id)->with('penalty')->first();
        $payments = $loan->payment;

        // get sum of penalty payment
        $penalty_payments = PenaltyPayment::where('penalty_id', $loan->penalty_id)->get();
        $sumPenaltyPayments = $penalty_payments->sum('penalty_payment_amount');

        return view('member-views.your-loans.member-loan-details',
            compact(
                'loan',
                'payments',
                'sumPenaltyPayments'
            ));
    }
}
