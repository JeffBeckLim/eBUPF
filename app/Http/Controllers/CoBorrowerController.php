<?php

namespace App\Http\Controllers;

use App\Models\Campus;
use App\Models\Loan;
use App\Models\CoBorrower;
use App\Models\Member;
use App\Models\Witness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoBorrowerController extends Controller
{
    //
    public function show(){

        // Get all the Loans with CoBorrowers, where in the member ID in the CO-Borrower table must match 
        // the id of the member logged in
        $requests = CoBorrower::with('Loan')->where('member_id', Auth::user()->member->id)->get();
        
        // intialize the array, this will store the loan associated with the Principal Borrowers data
        $loans=[];
        if(count($requests) != 0){   
            // foreach($requests as $request){

            //     // get the loans of the Co-borrower and the Principal Borrowers Details
            //     $temp = Loan::with('Member')->where('id', $request->loan->id)->get();

            //     // Eager loading units  
            //     $temp[0]->Member->load('units');
                
            //     array_push($loans, $temp);
            // }

            $loanIds = $requests->pluck('loan.id')->toArray();

            $loans = Loan::with(['Member', 'Member.units'])
                ->whereIn('id', $loanIds)
                ->get();
            
        }

        // $requests = CoBorrower::with('Loan', 'member')->where('member_id', Auth::user()->member->id)->get();

      
        return view('member-views.coborrower-requests', compact('loans'));
    }

    public function showLoan($id){

        $loan = Loan::with(['Member', 'Member.units.campuses'])->find($id);
        $co_borrower=CoBorrower::with('member')->where('loan_id', $id)->first();
        $witnesses=Witness::with('member')->where('loan_id', $id)->get();



        // dd($witnesses[0]->member->firstname);

        return view('member-views.loan-application-details', compact('loan', 'co_borrower', 'witnesses'));
    }
}
