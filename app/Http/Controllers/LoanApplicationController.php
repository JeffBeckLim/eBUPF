<?php

namespace App\Http\Controllers;

use App\Models\CoBorrower;
use App\Models\Loan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanApplicationController extends Controller
{
    //
    public function show(){

        $users = User::with('member')->get();

        return view('member-views.mpl-application-form.mpl-application-form', compact('users'));
    }
    public function storeRequest(Request $request){
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


        $formFields = $request->validate([
            'email_co_borrower' => 'required|email|exists:users,email',
            'principal_amount'=> ['required', 'numeric', 'min:50000', 'max:200000'],
            'term_years'=> ['required', 'numeric', 'min:1', 'max:5'],
            
            'email_witness_1'=> 'required',
            'email_witness_2'=> 'required',
        ]);
        $co_borrower = User::where('email', $request->email_co_borrower)->with('member')->first();
        // dd($co_borrower);


        $loan = Loan::create([
            'member_id'=>Auth::user()->id,
            // 'loan_type_id'=>1,
            'principal_amount'=>$formFields['principal_amount'],
            'term_years'=>$formFields['term_years'],
        ]);

        CoBorrower::create([
            'member_id'=>$co_borrower->member->id,
            'loan_id'=>$loan->id,
        ]);
        return back()->with('message', 'Loan Application Request Sent!');
        // dd($formFields);

        // COBORROWER TABLE -----------
        // 'member_id',
        // 'loan_id',
        // 'accept_request',


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
