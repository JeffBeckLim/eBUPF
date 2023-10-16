<?php

namespace App\Http\Controllers;

use finfo;
use App\Models\Loan;
use App\Models\CoBorrower;
use App\Models\Amortization;
use App\Models\LoanCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\LoanApplicationState;
use App\Models\LoanApplicationStatus;

class AdminLoanApplicationController extends Controller
{
    public function updateLoan(Request $request , $id){

        $loan=Loan::findOrFail($id);
        $request->validate([
            'principal_amount'=> 'required|numeric|min:10000|max:200000',
            'interest'=> 'nullable|numeric|min:1000|max:200000',
            'term_years'=> 'required|numeric|min:1|max:5',
            'category'=> 'nullable|numeric',
        ]);

        $loan->principal_amount = $request->principal_amount;
        $loan->interest = $request->interest;
        $loan->term_years = $request->term_years;
        $loan->loan_category_id = $request->category;
        $loan->save();



        // if no amortization exist yet and interest was added
        if($loan->amortization_id == null && $request->interest != null){
            $amort_principal = $request->principal_amount/($loan->term_years * 12);
            $amort_interest = $request->interest/($loan->term_years * 12);
            $amortization = Amortization::create([
                'amort_principal' => $amort_principal,
                'amort_interest' => $amort_interest,
                // 'amort_start' => $request->amort_start,
                // 'amort_end' => $request->amort_end,
            ]);

            $loan->amortization_id = $amortization->id;
            $loan->save();

            return back()->with('success', 'Loan Updated and Amortization Added!');
        }
        // if amortization is added but interest is added
        elseif($loan->amortization_id != null && $request->interest != null){
            // $amortization = DB::table('amortizations')->where('id', $loan->amortization_id)->get();
            $amortization = Amortization::where('id', $loan->amortization_id)->first();
            $amort_principal = $request->principal_amount/($loan->term_years * 12);
            $amort_interest = $request->interest/($loan->term_years * 12);


            $amortization->amort_principal = $amort_principal;
            $amortization->amort_interest = $amort_interest;
            $amortization->save();

            return back()->with('success', 'Loan and Amortization Updated!');
        }
        return back()->with('success', 'Loan Updated!');
    }

    public function showLoanApplications( $loanType ,$table_freeze){

        // dd($loanType);

        $raw_loans = Loan::with('member.units' , 'loanApplicationStatus.loanApplicationState' , 'loanCategory', 'amortization', 'adjustment', 'check')->has('loanApplicationStatus')
        ->where('loan_type_id', $loanType)
        ->get();

        $loans = [];
        foreach($raw_loans as $raw_loan){
            $status_array = [];
            foreach($raw_loan->loanApplicationStatus as $status){
                array_push($status_array, $status->loan_application_state_id);
            }
            if(in_array(3,$status_array) && !in_array(6,$status_array)){
                array_push($loans, $raw_loan);
            }
        }



        $loan_categories = LoanCategory::all();


        return view('admin-views.admin-loan-applications.admin-loan-applications', compact('loans' , 'loan_categories', 'table_freeze', 'loanType'));
    }


    public function updateLoanApplicationAmount(Request $request, $id){
        $request->validate([
            'principal_amount'=> ['required', 'numeric', 'min:50000', 'max:200000'],
        ]);
        $loan = Loan::findOrFail($id);
        $loan->principal_amount = $request->principal_amount;
        $loan->save();
        return back();
    }


    public function createLoanApplicationCategory(Request $request, $id){
        $loan = Loan::findOrFail($id);
        $loan->loan_category_id = $request->category;
        $loan->save();

        return back()->with('state_update','Loan category added!');
    }


    public function createLoanApplicationState(Request $request, $id){

        $loan = Loan::findOrFail($id);
        $loan->is_active =$request->is_active;
        $loan->save();

        return back()->with('state_update', 'Loan State Updated');
    }

    public function deleteLoanStatus($id){


        $status = LoanApplicationStatus::findOrFail($id);


        $loan = Loan::findOrFail($status->loan_id)->with('loanApplicationStatus')->first();

        $status_array = [];
        foreach($loan->loanApplicationStatus as $item){
            array_push($status_array, $item->loan_application_state_id);
        }

        if($status->loan_application_state_id ==  1 || $status->loan_application_state_id ==  2 && in_array(5 , $status_array)){
            return back()->with('deleted_status', 'Cannot delete status 1 or 2, when "approved" status exists');
        }


        if($status->loan_application_state_id ==  4 && in_array(5 , $status_array)){
            return back()->with('deleted_status', 'Cannot delete "check" status, when "picked-up" status exists');
        }

        if($status->loan_application_state_id ==  3 && in_array(4 , $status_array)){
            return back()->with('deleted_status', 'Cannot delete "approved" status, when "check" status exists');
        }
        elseif($status->loan_application_state_id ==  3 && in_array(5 , $status_array)){
            return back()->with('deleted_status', 'Cannot delete "approved" status, when "check" or "picked" status exists');
        }

        $status->delete();

        return back()->with('deleted_status', 'Status deleted');

    }

    // get all MPL or HSL loan applications that are accepted by CoBorrower
    public function showLoanApplicationsTracking($loan_type){
        if($loan_type == 'mpl'){

            $loans = CoBorrower::with('loan.member.units.campuses', 'loan.loanApplicationStatus.loanApplicationState', 'loan.loanCategory')
            ->where('accept_request', 1)
            ->whereHas('loan', function($query){
                $query->where('loan_type_id',  1); //loan type of MPL
            })->get();

        }elseif($loan_type == 'hsl'){

            $loans = CoBorrower::with('loan.member.units.campuses', 'loan.loanApplicationStatus.loanApplicationState' , 'loan.loanCategory')
            ->where('accept_request', 1)
            ->whereHas('loan', function($query){
                $query->where('loan_type_id',  2); //loan type of HSL
            })->get();

        }else{
            abort(404);
        }


        $loan_app_states = LoanApplicationState::all();
        $loan_categories = LoanCategory::all();


        $approved= 0;
        $denied = 0;
        $pending = 0;
        foreach($loans as $loan){
            if(count($loan->loan->loanApplicationStatus) == 0){
                $pending += 1;
            }
            foreach($loan->loan->loanApplicationStatus as $state){
                if($state->loan_application_state_id == 3){
                    $approved += 1;
                }
                elseif($state->loan_application_state_id == 6){
                    $denied += 1;
                }
            }
        }
        return view('admin-views.admin-loan-applications-tracking.admin-loan-applications-tracking', compact('loans', 'loan_app_states', 'loan_categories', 'approved' , 'denied', 'pending' ,'loan_type'));
    }



    public function createLoanApplicationStatus(Request $request, $loan_id){
        //Validate if loan exists
        $loan = Loan::findOrFail($loan_id);

        $formFields = $request->validate([
            'loan_application_state_id' => 'required',
            'remarks'=>'nullable',
            'date_evaluated'=>'nullable',
        ]);

        $status = DB::table('loan_application_statuses')
            ->where([
                ['loan_id', '=', $loan_id],
                ['loan_application_state_id', '=', $formFields['loan_application_state_id']],
            ])
            ->get();

        // check if the status selected already exist ( BACK UP VALIDATION )
        if(count($status) != 0){
            return back()->with('status_error', 'The loan already has that status.');
        }

        $new_loan_status = LoanApplicationStatus::create([
            'loan_id' => $loan->id,
            'loan_application_state_id' => $formFields['loan_application_state_id'],
            'date_evaluated'=>$formFields['date_evaluated'],
            'remarks'=>$formFields['remarks'],
        ]);

        if($new_loan_status->loan_application_state_id == 5){
            $loan->is_active = 1;
            $loan->save();

            return back()->with('success', 'New status added successfully and set as Performing Loan');
        }

        return back()->with('success', 'New status added successfully!');
    }
}
