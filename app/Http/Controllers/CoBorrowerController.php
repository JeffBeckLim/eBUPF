<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use App\Models\Campus;
use App\Models\Member;
use App\Models\Witness;
use App\Models\CoBorrower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoBorrowerController extends Controller
{
    public function changeCbUpdate(Request $request, $id){
        $loan = Loan::findOrFail($id);

        // check if sakniyang loan
        if(Auth::user()->member->id != $loan->member_id){
            abort(404);
        }
        // check for active loans
        $coBorrower = CoBorrower::where('loan_id', $id)->with('member.user')->first();

        $validatedData = $request->validate([
            'email_co_borrower' => 'required|email',
        ]);
        $co_borrower_new = User::where('email',$validatedData['email_co_borrower'])->with('member')->first();

        // check if same cb parin na enter
        if($co_borrower_new==null){
            return back()->with('error', 'Does not exist');
        }
        else if($coBorrower->member->user->email == $validatedData['email_co_borrower']){
            return back()->with('error', 'You cannot enter the same co-borrower');
        }
        //check if member si CB
        else if($co_borrower_new->user_type != 'member'){
            return back()->with('error', 'Not a member email');
        }

        $coBorrower->member_id = $co_borrower_new->member->id;
        $coBorrower->accept_request = null;
        $coBorrower->save();
        
        $loan->is_active = null;
        $loan->save();

        return redirect(route('outgoing.request'))->with('success', 'Co-borrower changed');

    }

    public function changeCb($id){

        $loan = Loan::findOrFail($id);
        if(Auth::user()->member->id != $loan->member_id){
            abort(404);
        }
        $pending_loans = Loan::whereNull('is_active')->where('member_id',Auth::user()->member->id)->get();

        if(count($pending_loans) != 0){
            abort(404);
        }

        $coBorrower = CoBorrower::where('loan_id', $id)->with('member.user')->first();
        $currentCbEmail = $coBorrower->member->user->email;

        $members = User::where('user_type', 'member')->get();
        $member_emails = [];
        foreach($members as $member){
            array_push($member_emails, $member->email);
        }
        $user_email = Auth::user()->email;
        return view('member-views.your-request.change-cb' , compact('member_emails','user_email','loan', 'currentCbEmail'));
        
    }


    public function showYourRequest(){

        // $load=CoBorrower::with('Loan.Member')->where('Loan.Member.id', Auth::user()->member->id)->get();
        $cb_withLoans = CoBorrower::with('member.units.campuses','loan.member.units.campuses', 'loan.loanType')
            ->whereHas('loan.member', function ($query) {
                $query->where('id', Auth::user()->member->id);
            })
            ->get();
        
        $cb_withLoans = collect($cb_withLoans)->sortByDesc('created_at')->values()->all();    

        $pending_loans = Loan::whereNull('is_active')->where('member_id',Auth::user()->member->id)->get();

        return view('member-views.your-request.your-request', compact('cb_withLoans','pending_loans'));

    }   

    //
    public function show(){

        // Get all the Loans with CoBorrowers, where in the member ID in the CO-Borrower table must match 
        // the id of the member logged in
        $requests = CoBorrower::with('Loan')
        ->where('member_id', Auth::user()->member->id)
        ->whereHas('Loan', function($query){
            $query->where('deleted_at', null);
        })
        ->get();
        
        // intialize the array, this will store the loan associated with the Principal Borrowers data
        $loans=[];
        if(count($requests) != 0){   
            $loanIds = $requests->pluck('loan.id')->toArray();   
            // Hindi man ata to nagagamit na Member, and Member.units.campuses data
            $loans = CoBorrower::with(['Member', 'Member.units.campuses', 'Loan.LoanType', 'Loan.Member.units.campuses',])
                ->whereIn('id', $loanIds)->get();
        }
        // SORT LOANS FROM THE LATEST TO THE OLDEST
        $loans = collect($loans)->sortByDesc('created_at')->values()->all();

      

        return view('member-views.co-borrower-request.coborrower-requests', compact('loans'));
    }

    public function showLoan($id){
        $loan = Loan::with(['Member', 'Member.units.campuses','LoanType'])->findOrFail($id);
        $co_borrower=CoBorrower::with('member')->where('loan_id', $id)->first();

        // check if the loan detail being accessed is associated with the Auth User as
        // the co borrower
        if(Auth::user()->member->id != $co_borrower->member->id
            && $loan->member_id != Auth::user()->member->id
        ){
            abort(403);
        }

        $witnesses=Witness::where('loan_id', $id)->get();
       
        // viewed indicator (in the page a 'NEW' icon is displayed when 'is_viewed' field is null 
        // when a user views it, then this code si triggered to set date when it was viewed now() ) s
        if(Auth::user()->member->id != $loan->member_id){
            if(is_null($loan->is_viewed)){
                $loan->is_viewed = now();
                $loan->save();
            }
        }

        return view('member-views.co-borrower-request.loan-application-details', compact('loan', 'co_borrower', 'witnesses'));
    }

    public function requestAccept($id){
        
        $coBorrower=CoBorrower::findorfail($id);
        if($coBorrower->accept_request == '1'){
            return redirect('/member/coBorrower/requests/')->with('message', 'You have already accepted this request');    
        }
        else{
            $coBorrower->update(['accept_request' => '1']);
        
            return redirect('/member/coBorrower/requests/')->with('message', 'Request accepted! The form is now available for the borrower ready for printing and signing');
        }

    }
    public function requestDecline($id){

        $coBorrower=CoBorrower::findorfail($id);
        $loan=Loan::where('id',$coBorrower->loan_id)->first();
        
        if($coBorrower->accept_request == '0'){
            return redirect('/member/coBorrower/requests/')->with('message', 'You have already declined this request');    
        }
        else{
            $coBorrower->update(['accept_request' => '0']);

            $loan->is_active = 2;
            $loan->save();
        
            return redirect('/member/coBorrower/requests/')->with('message', 'Request Declined');
        }
    }
}
