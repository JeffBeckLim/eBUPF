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

            $loans = Loan::with(['Member', 'Member.units', 'LoanType'])
                ->whereIn('id', $loanIds)
                ->get();
            
        }
        // dd($loans[0]->loanType);
        // SORT LOANS FROM THE LATEST TO THE OLDEST
        $loans = collect($loans)->sortByDesc('created_at')->values()->all();
      
        return view('member-views.co-borrower-request.coborrower-requests', compact('loans'));
    }

    public function showLoan($id){

        $loan = Loan::with(['Member', 'Member.units.campuses'])->find($id);
        $co_borrower=CoBorrower::with('member')->where('loan_id', $id)->first();
        $witnesses=Witness::with('member')->where('loan_id', $id)->get();
        

        return view('member-views.co-borrower-request.loan-application-details', compact('loan', 'co_borrower', 'witnesses'));
    }
}
