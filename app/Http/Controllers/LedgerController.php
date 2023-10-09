<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Member;
use App\Models\Payment;
use Illuminate\Http\Request;

class LedgerController extends Controller
{
    public function show(){
        $raw_members = Member::with('loans.loanApplicationStatus','user' , 'loans.loanType' , 'units.campuses')->has('loans')
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

        $raw_loans = Loan::where('member_id' , $id)->where('loan_type_id' , $loan_type_id)->with('loanCategory' , 'loanType' , 'loanApplicationStatus' )->get();

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
        $loan = Loan::with('loanType' , 'amortization' , 'loanApplicationStatus' , 'payment')->where('id' , $id)->first();

        // get principal and interest PAID
        $principal_paid = 0;
        $interest_paid = 0;
        $payment_ids = [];
        foreach($loan->payment as $payment){
            $principal_paid += $payment->principal;
            $interest_paid += $payment->interest;
            
            array_push($payment_ids, $payment->id);
        }

        $latest_payment = Payment::find(max($payment_ids));

        return view('admin-views.admin-ledgers.admin-personal-ledger', compact('loan' , 'principal_paid', 'interest_paid', 'latest_payment'));
    }

}
