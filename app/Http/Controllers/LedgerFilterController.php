<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Member;
use Illuminate\Http\Request;

class LedgerFilterController extends Controller
{
    public function show(Request $request){
        
        if($request->query('unit_filter') == 0 )
        {
            return redirect()->route('admin.ledgers');
        }else{
            $unit_selected = $request->query('unit_filter');
        }

        $raw_members = Member::with('loans.loanApplicationStatus','user' , 'loans.loanType' , 'loans.amortization' ,'units.campuses' , 'loans.loanApplicationStatus')->has('loans.amortization')
        ->get();


        // CHECK IF A MEMBER HAS A CHECK picked up Status
        // Remember that check pick up status id == 5
        $members=[];
        foreach($raw_members as $raw_member){   
            if ($raw_member->units->id == $unit_selected) {    
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
        }
        $units = Unit::all();
        return view('admin-views.admin-ledgers.admin-ledgers', compact('members','units','unit_selected'));


        dd($request);
    }
}
