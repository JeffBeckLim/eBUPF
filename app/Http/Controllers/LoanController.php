<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Loan;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Models\PenaltyPayment;
use App\Models\LoanApplicationState;
use Illuminate\Support\Facades\Auth;
use App\Models\LoanApplicationStatus;

class LoanController extends Controller
{

    public function show($loan_status){

        if($loan_status == 'performing'){
            $loan_status = 1;
        }elseif($loan_status == 'paid'){
            $loan_status = 2;
        }else{
            $loan_status = 3;
        }

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
        $selectedYear = request('year');

        $loan = Loan::where('id', $id)->with('penalty')->first();

        if ($selectedYear == null) {
            $latestPayment = $loan->payment()->latest('payment_date')->first();

            // Check if $latestPayment is not null before accessing its properties
            if ($latestPayment) {
                $selectedYear = Carbon::parse($latestPayment->payment_date)->format('Y');
            } else {
                $selectedYear = Carbon::parse($loan->amortization->amort_start)->format('Y');
            }
        }

        if($loan == null){
            abort(403);
        }

        // check if  user is the owner of the loan
        if(Auth::user()->member->id != $loan->member_id){
            abort(403);
        }

        // check if loan has check picked up status
        $loan_app_status = LoanApplicationStatus::where('loan_id', $loan->id)->where('loan_application_state_id' , 5)->first();
        if($loan_app_status == null){
            abort(403);
        }

        $payments = $loan->payment;
        $amortizationStart = $loan->amortization->amort_start;
        $amortizationEnd = $loan->amortization->amort_end;

        $years = [];
        if ($amortizationStart && $amortizationEnd) {
            $startYear = Carbon::parse($amortizationStart)->format('Y');
            $endYear = Carbon::parse($amortizationEnd)->format('Y');

            $years = range($startYear, $endYear);
        }

        if (empty($years)) {
            $years[] = Carbon::now()->format('Y');
        }



        // get sum of penalty payment
        $penalty_payments = PenaltyPayment::whereIn('penalty_id', $loan->penalty->pluck('id'))
        ->orderBy('created_at', 'desc')
        ->get();

        $sumPenaltyPayments = $penalty_payments->sum('penalty_payment_amount');

        $payments = $loan->payment;

        $beginningBalance = [];
        $endingBalance = [];

        $cumulativePrincipal = $loan->principal_amount;
        $cumulativeInterest = $loan->interest;

        // Loop through payments to calculate balances
        foreach ($payments as $index => $payment) {
            $paymentYear = date('Y', strtotime($payment->payment_date));

            // Calculate balances based on the payment year
            $beginningBalance[$paymentYear] = $cumulativePrincipal + $cumulativeInterest;
            $endingBalance[$paymentYear] = $beginningBalance[$paymentYear] - ($payment->principal + $payment->interest);

            // Update cumulative balances
            $cumulativePrincipal -= $payment->principal;
            $cumulativeInterest -= $payment->interest;

            // Assign balances
            $payment->year = $paymentYear;
            $payment->selected_year_beginning_balance = $beginningBalance[$paymentYear];
            $payment->selected_year_ending_balance = $endingBalance[$paymentYear];
        }

        // Store balances for all years
        $allYearBalances = [];
        foreach ($payments as $payment) {
            $allYearBalances[] = [
                'year' => $payment->year,
                'beginning_balance' => $payment->selected_year_beginning_balance,
                'ending_balance' => $payment->selected_year_ending_balance,
            ];
        }

        return view('member-views.your-loans.member-loan-details',
            compact(
                'loan',
                'payments',
                'sumPenaltyPayments',
                'years',
                'selectedYear',
                'allYearBalances'
            ));
    }


    public function displayLoanLedger($id){
        $loan = Loan::where('id', $id)->with('penalty')->first();

        if($loan == null){
            abort(403);
        }

        // check if  user is the owner of the loan
        if(Auth::user()->member->id != $loan->member_id){
            abort(403);
        }

         // add error catcher here to make sure that loang being retrieved is valid
         $loan = Loan::with('loanType' , 'amortization' , 'loanApplicationStatus' , 'payment', 'member.units' , 'loanCategory', 'penalty')->where('id' , $id)->first();

         if($loan == null){
             abort('403');
         }

         // $penalty_payments = PenaltyPayment::where('penalty_id' , $loan->penalty_id)
         // ->orderBy('created_at', 'desc')
         // ->get();

         $penalty_payments = PenaltyPayment::whereIn('penalty_id', $loan->penalty->pluck('id'))
         ->orderBy('created_at', 'desc')
         ->get();


         $sumPenaltyPayments = $penalty_payments->sum('penalty_payment_amount');

         // if loan has missing amortization
         if($loan->amortization == null){
             return abort(401, 'Oops! This loan has some field missing.');
         }

         if($loan->amortization != null){
             if($loan->amortization->amort_start == null || $loan->amortization->amort_end == null ){
                 return abort(403, 'Oops! This loan has some field missing in amortization period.');
             }
         }
         // get principal and interest PAID
         $principal_paid = 0;
         $interest_paid = 0;
         $payment_ids = [];

         // get total payments
         foreach($loan->payment as $payment){
             $principal_paid += $payment->principal;
             $interest_paid += $payment->interest;

             array_push($payment_ids, $payment->id);
         }

          // Get all payments
          $paymentsMade = Payment::where('loan_id', $loan->id)->get();


         // Get unique year and month combinations to get the total number of payments
         $uniquePayments = [];

         foreach ($paymentsMade as $payment) {
             $paymentDate = Carbon::parse($payment->payment_date);
             $yearMonth = $paymentDate->format('Y-m'); // Get year and month format

             // Check if the year and month combination already exists
             if (!isset($uniquePayments[$yearMonth])) {
                 $uniquePayments[$yearMonth] = true; // Add if it doesn't exist
             }
         }

         $totalUniquePayments = count($uniquePayments);

         //Filter the payments by year and month
          $filteredPayments = [];
          foreach($paymentsMade as $payment){
              $paymentDate = Carbon::parse($payment->payment_date);
              $filteredPayments[$paymentDate->format('Y')][$paymentDate->format('F')][] = $payment;
          }

         // check if has any payments if none, no latest payment returned
         if(count($payment_ids) != null){
             $latest_payment = Payment::find(max($payment_ids));
         }else{
             $latest_payment = null;
         }

         $amort_start_parsed = Carbon::parse($loan->amortization->amort_start);
         for ($x = $loan->term_years; $x != 0; $x--){

             $targetMonth = 1;
             $targetYear = $amort_start_parsed->copy()->addMonths($x * 12)->format('Y');


             $filteredPaymentModes = Payment::whereYear('payment_date', $targetYear)
             ->whereMonth('payment_date', $targetMonth)
             ->get();
         }

         $raw_loans = Loan::where('member_id' , $loan->member_id)->where('loan_type_id' , $loan->loan_type_id)->with('loanCategory' , 'loanType' , 'loanApplicationStatus' , 'amortization')->whereHas('amortization')
         ->orderBy('created_at', 'desc')
         ->get();

         // get the loans of the member for the dropdown
         $memberLoans = [];
         foreach($raw_loans as $raw_loan){
             $status_array = [];
             foreach($raw_loan->loanApplicationStatus as $status){
                     array_push($status_array, $status->loan_application_state_id);
                 }
                 if(in_array(5, $status_array)){
                     array_push($memberLoans, $raw_loan);
                 }
             }

             $months = [
                 'January', 'February', 'March', 'April', 'May', 'June',
                 'July', 'August', 'September', 'October', 'November', 'December'
             ];


         return view('member-views.your-loans.member-ledger-view',
         compact(
             'loan' ,
             'principal_paid',
             'interest_paid',
             'latest_payment' ,
             'memberLoans',
             'months' ,
             'penalty_payments',
             'sumPenaltyPayments',
             'filteredPayments',
             'totalUniquePayments'
         ));

        // return view('member-views.your-loans.member-ledger-view');
    }
}
