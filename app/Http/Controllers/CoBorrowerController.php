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
            $loanIds = $requests->pluck('loan.id')->toArray();   
            $loans = CoBorrower::with(['Member', 'Member.units.campuses', 'Loan.LoanType', 'Loan.Member.units.campuses',])
                ->whereIn('id', $loanIds)->get();

                   // $loans = Loan::with(['Member', 'Member.units', 'LoanType'])
                    //     ->whereIn('id', $loanIds)
                    //     ->get();

                        // foreach($requests as $request){

                    //     // get the loans of the Co-borrower and the Principal Borrowers Details
                    //     $temp = Loan::with('Member')->where('id', $request->loan->id)->get();

                    //     // Eager loading units  
                    //     $temp[0]->Member->load('units');
                        
                    //     array_push($loans, $temp);
                    // }
        }
        // SORT LOANS FROM THE LATEST TO THE OLDEST
        $loans = collect($loans)->sortByDesc('created_at')->values()->all();
      
        return view('member-views.co-borrower-request.coborrower-requests', compact('loans'));
    }

    public function showLoan($id){

        $loan = Loan::with(['Member', 'Member.units.campuses','LoanType'])->find($id);
        $co_borrower=CoBorrower::with('member')->where('loan_id', $id)->first();
        $witnesses=Witness::with('member')->where('loan_id', $id)->get();

        return view('member-views.co-borrower-request.loan-application-details', compact('loan', 'co_borrower', 'witnesses'));
    }

    public function requestAccept($id){
        
        $coBorrower=CoBorrower::findorfail($id);
        if($coBorrower->accept_request == '1'){
            return redirect('/member/coBorrwer/requests/')->with('message', 'You have already accepted this request');    
        }
        else{
            $coBorrower->update(['accept_request' => '1']);
        
            return redirect('/member/coBorrwer/requests/')->with('message', 'Request accepted! The form is now available for the borrower ready for printing and signing');
        }
        // dd($coBorrower);

    }
    public function requestDecline($id){
        // $coBorrower=CoBorrower::findorfail($id);
        // $coBorrower->update(['accept_request' => '0']);
        // dd($coBorrower);

        $coBorrower=CoBorrower::findorfail($id);
        if($coBorrower->accept_request == '0'){
            return redirect('/member/coBorrwer/requests/')->with('message', 'You have already declined this request');    
        }
        else{
            $coBorrower->update(['accept_request' => '0']);
        
            return redirect('/member/coBorrwer/requests/')->with('message', 'Request Declined');
        }
    }
}
