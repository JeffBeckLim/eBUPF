<?php

namespace App\Http\Controllers;

use App\Models\Member;
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

    public function showMemberLedgers(){
        return view('admin-views.admin-ledgers.admin-members-ledgers');
    }
}
