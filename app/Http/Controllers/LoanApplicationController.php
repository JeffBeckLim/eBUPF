<?php

namespace App\Http\Controllers;

use App\Models\CoBorrower;
use App\Models\Loan;
use App\Models\LoanApplicationState;
use App\Models\LoanApplicationStatus;
use App\Models\User;
use App\Models\Witness;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class LoanApplicationController extends Controller
{


    public function showLoanStatus($loan_id){
        $loan = Loan::with('loanType')->where('id',$loan_id)->first();
        if($loan==null){
            abort(404);
        }elseif ($loan->member_id != Auth::user()->member->id) {
            abort(404);
        }

        $loan_status=LoanApplicationStatus::with('LoanApplicationState')
        ->where('loan_id', $loan_id)
        ->whereNull('is_deleted') //get status that are not deleted
        ->orderBy('loan_application_state_id', 'desc')
        ->get();

        // if loan has no status abort
        if(count($loan_status)==null){
            abort(404);
        }

        return view('member-views.loan-applications.loan-application-status', compact('loan_status', 'loan'));
    }

    //SHOW MPL APPLICATION FORM
    public function show(){
        return view('member-views.mpl-application-form.mpl-application-form');
    }

    // SHOW HSL APPLICATION FORM
    public function showHsl(){
        return view('member-views.hsl-application-form.hsl-application-form');
    }



    // SHOW LIST OF LOAN APPLICATIONS
    public function showLoanApplications(){

        $loans = CoBorrower::with(
            'member.units.campuses',
            'loan.member.units.campuses',
            'loan.loanApplicationStatus.loanApplicationState',
            'loan.loanType',
            //get loans with status
            )
            ->where('accept_request', '1') //get loans accepted by coBorrower
            ->whereHas('loan', function ($query){
                $query->where('member_id', Auth::user()->member->id);
            })->get();
            // ->has('loan.loanApplicationStatus')


        return view('member-views.loan-applications.loan-applications', compact('loans'));
    }


    // ============================VALIDATE AND STORE MPL APPLICATION==============================
    public function storeRequest(Request $request, $loanTypeId){
        if($loanTypeId > 2){
            abort(404);
        }
        $formFields = $request->validate([
            'email_co_borrower' => 'required|email|exists:users,email',
            'principal_amount'=> ['required', 'numeric', 'min:50000', 'max:200000'],
            'term_years'=> ['required', 'numeric', 'min:1', 'max:5'],

            'email_witness_1'=> 'required|email|exists:users,email',
            'email_witness_2'=> 'required|email|exists:users,email',
        ]);

        // check if the email inputs are the same with the User's logged in email
        // -- I COMMENTED THIS OUT FIRST FOR TESTING PURPOSES SO DEVELOPERS CAN TEST THE CO-BORROWER FUNCTIONALITY
        // -- WITH THE LOGGED IN EMAIL
        // if(
        //     $request->email_co_borrower == Auth::user()->email ||
        //     $request->email_witness_1 == Auth::user()->email ||
        //     $request->email_witness_2 == Auth::user()->email)
        // {
        //     return back()->with('email_error', 'You cannot enter your own email');
        // }
        if($request->email_witness_1 == $request->email_witness_2 ||
            $request->email_witness_1 == $request->email_co_borrower ||
            $request->email_witness_2 == $request->email_co_borrower
        ){
            return back()->with('email_error', 'Make sure all emails are unique');
        }

        $co_borrower = User::where('email', $request->email_co_borrower)->with('member')->first();
        $witness_1 = User::where('email', $request->email_witness_1)->with('member')->first();
        $witness_2 = User::where('email', $request->email_witness_2)->with('member')->first();

        if(
            !$co_borrower->member->verified_at
            || !$witness_1->member->verified_at
            || !$witness_2->member->verified_at
        ){
            return back()->with('email_error', 'Make sure that all emails are from verified eBUPF members');
        }

        $loan = Loan::create([
            'member_id'=>Auth::user()->id,
            'loan_type_id'=>$loanTypeId,
            'principal_amount'=>$formFields['principal_amount'],
            'term_years'=>$formFields['term_years'],
        ]);

        CoBorrower::create([
            'member_id'=>$co_borrower->member->id,
            'loan_id'=>$loan->id,
        ]);

        Witness::create([
            'member_id'=>$witness_1->member->id,
            'loan_id'=>$loan->id,
        ]);

        Witness::create([
            'member_id'=>$witness_2->member->id,
            'loan_id'=>$loan->id,
        ]);

        return view('member-views.mpl-application-form.confirmation');
    }
} // THIS IS THE LAST TAG
