<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Loan;
use App\Models\Member;
use App\Models\Payment;
use Illuminate\Http\Request;

class LedgerController extends Controller
{
    public function show(){
        $raw_members = Member::with('loans.loanApplicationStatus','user' , 'loans.loanType' , 'loans.amortization' ,'units.campuses')->has('loans.amortization')
        ->get();

        // CHECK IF A MEMBER HAS A CHECK picked up Status
        // Remember that check pick up status id == 5
        $members=[];
        foreach($raw_members as $raw_member){
            foreach($raw_member->loans as $loan){
                
                    $status_array=[];
                    foreach($loan->loanApplicationStatus as $status){
                        array_push($status_array, $status->loan_application_state_id);
                    }
                    if(in_array(5,$status_array)){
                        array_push($members, $raw_member);
                        break;
                    }
            }
        }
        
        return view('admin-views.admin-ledgers.admin-ledgers', compact('members'));
    }

    public function showMemberLedgers( $loan_type , $id){
        if($loan_type == 'mpl'){
            $loan_type_id = 1;
        }elseif($loan_type == 'hsl'){
            $loan_type_id = 2;
        }
        $member = Member::with('units.campuses')->where('id' , $id)->first();

        $raw_loans = Loan::where('member_id' , $id)->where('loan_type_id' , $loan_type_id)->with('loanCategory' , 'loanType' , 'loanApplicationStatus' , 'amortization', 'penalty')->has('amortization')->get();

        // dd($raw_loans);
        $loans = [];
        foreach($raw_loans as $raw_loan){
            $status_array = [];
            foreach($raw_loan->loanApplicationStatus as $status){
                    array_push($status_array, $status->loan_application_state_id);
                }
                if(in_array(5, $status_array)){
                    array_push($loans, $raw_loan);
                }
            }
        
        // dd($loans);
        return view('admin-views.admin-ledgers.admin-members-ledgers' , compact('loans' , 'loan_type' ,'member'));
    }

    public function showPersonalLedger($id){
        // add error catcher here to make sure that loang being retrieved is valid
        $loan = Loan::with('loanType' , 'amortization' , 'loanApplicationStatus' , 'payment', 'member.units' , 'loanCategory')->where('id' , $id)->first();

        // if loan has missing amortization 
        if($loan->amortization == null){
            return abort(403, 'Oops! This loan has some field missing.');
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

        // get the loans of the member
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
            
        
        return view('admin-views.admin-ledgers.admin-personal-ledger', compact('loan' , 'principal_paid', 'interest_paid', 'latest_payment' , 'memberLoans', 'months'));
    }

}
