<?php

namespace App\Http\Controllers;

use App\Models\CoBorrower;
use App\Models\Loan;
use App\Models\User;
use App\Models\Witness;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanApplicationController extends Controller
{
    //SHOW MPL APPLICATION FORM
    public function show(){
        return view('member-views.mpl-application-form.mpl-application-form');
    }
    public function showHsl(){
        return view('member-views.hsl-application-form.hsl-application-form');
    }
    public function storeRequestHsl(Request $request){
        dd($request);
    }
    // VALIDATE AND STORE LOAN APPLICATION
    public function storeRequest(Request $request){

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
        if($request->email_witness_1 == $request->email_witness_2){
            return back()->with('email_error', 'Make sure witness emails are unique');
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
            'loan_type_id'=>1,
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


        return back()->with('message', 'Loan Application Request Sent!');
        // dd($formFields);

        // COBORROWER TABLE -----------
        // 'member_id',
        // 'loan_id',
        // 'accept_request',s


        // LOANS TABLE ----------------
        // 'member_id', \\
        // 'loan_type_id',\\
        // 'amortization_id',
        // 'adjustment_id',
        // 'loan_category_id',
        // 'principal_amount',\\
        // 'interest', 
        // 'term_years',\\s
        // 'is_visible',
        //  'is_approved',
    }
}
