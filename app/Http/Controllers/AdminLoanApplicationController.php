<?php

namespace App\Http\Controllers;

use finfo;
use App\Models\Loan;
use App\Models\Unit;
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

    public function showLoanApplications(Request $request, $loanType ,$table_freeze){

        $raw_loans = Loan::with('member.units' , 'loanApplicationStatus.loanApplicationState' , 'loanCategory', 'amortization', 'adjustment', 'check', 'penalty')->has('loanApplicationStatus')
        ->where('loan_type_id', $loanType)
        ->get();

        $loans = [];

        // Check approved and not <denied></denied>
        $latest_id = 0;
        foreach($raw_loans as $raw_loan){
            $status_array = [];
            foreach($raw_loan->loanApplicationStatus as $status){
                array_push($status_array, $status->loan_application_state_id);
            }
            if(in_array(3,$status_array) && !in_array(6,$status_array)){
                if($raw_loan->id > $latest_id){
                    // get latest id 
                    $latest_id = $raw_loan->id;
                }
                array_push($loans, $raw_loan);
            }
        }

        // count
        $null_interest = 0;
        $incomplete_amort = 0;
        $no_loanType = 0;
        foreach($loans as $loan){
            if($loan->interest == null || $loan->interest == 0){
                $null_interest += 1;
            }

            if($loan->amortization == null){
                $incomplete_amort += 1;
            }
            elseif($loan->amortization->amort_start == null ||
                $loan->amortization->amort_end == null || 
                $loan->amortization->amort_principal == null || 
                $loan->amortization->amort_interest == null 
            ){
                $incomplete_amort += 1;
            }

            if($loan->loan_category_id == null){
                $no_loanType +=1;
            }


        }
        

        $loan_categories = LoanCategory::all();

        // get all units for select filter
        $units = Unit::all();

        // get all years for select filter
        $years = [];
        foreach ($loans as $loan) {
            $date_requested = Carbon::parse($loan->created_at)->year;
            array_push($years, $date_requested);
        }
        $years = array_unique($years);

        // initialize months for select filter
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];

        return view('admin-views.admin-loan-applications.admin-loan-applications', 
        compact(
            'loans' , 
            'loan_categories', 
            'table_freeze', 
            'loanType', 
            'incomplete_amort' , 
            'null_interest', 
            'no_loanType' , 
            'latest_id', 
            'units',
            'years',
            'months',            
            )
            ) ;
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

        $loan = Loan::where('id',$id)->with('loanApplicationStatus')->first();

        $loanApp = LoanApplicationStatus::where('loan_id',$loan->id)->get();
        dd($loanApp);

        if($request->is_active ==  1){

            $flag = 0;
            foreach($loan->loanApplicationStatus as $states){
                if($states->loan_application_state_id == 5){
                    $flag += 1;
                }
            }
            if($flag == 0){
                return back()->with('status_danger', 'This loan cannot be set to performing if "check" picked up" status is missing');
            }
        }

        $loan->is_active =$request->is_active;
        $loan->save();

        return back()->with('state_update', 'Loan State Updated');
    }

    public function deleteLoanStatus($id){

        $status = LoanApplicationStatus::findOrFail($id);

        $loan = Loan::where('id' ,$status->loan_id)->with('loanApplicationStatus')->first();

        $status_array = [];
        foreach($loan->loanApplicationStatus as $item){
            array_push($status_array, $item->loan_application_state_id);
        }

        

        if($status->loan_application_state_id ==  1 || $status->loan_application_state_id ==  2){
            if(in_array(5 , $status_array) || in_array(4 , $status_array) ||  in_array(3 , $status_array)){
                return back()->with('deleted_status', 'Cannot delete status 1 and 2, if status  3, 4 or 5 exists');
            }
            else{
                $status->delete();
                return back()->with('deleted_status_passed', 'Status deleted');
            }
        }
        elseif($status->loan_application_state_id ==  3){
            if(in_array(5 , $status_array) || in_array(4 , $status_array)){
            return back()->with('deleted_status', 'Cannot delete status 3 (Approved by exe.), if status 4 or 5 exists');}
            
            else{
                $status->delete();
                return back()->with('deleted_status_passed', 'Status deleted');
            }

        }
        elseif($status->loan_application_state_id ==  4 && in_array(5 , $status_array)){
            return back()->with('deleted_status', 'Cannot delete status 4 ( check ), if status 5 (picked up) exists');
        }
        elseif($status->loan_application_state_id ==  4 && in_array(5 , $status_array)){
            return back()->with('deleted_status', 'Cannot delete status 4 ( check ), if status 5 (picked up) exists');
        }
        elseif($status->loan_application_state_id ==  5){

            $loan->is_active = null; 
            $loan->save();
            $status->delete();

            return back()->with('deleted_status_passed', 'Status 5 (check picked up) deleted! Loan state set reverted to NONE');
        }
        else{
            $status->delete();
            return back()->with('deleted_status_passed', 'Status deleted');
        }
    }

    // get all MPL or HSL loan applications that are accepted by CoBorrower
    public function showLoanApplicationsTracking($loan_type){
        if($loan_type == 'mpl'){
            $loan_type_id = 1;
        }elseif($loan_type == 'hsl'){
            $loan_type_id = 2;
        }else{
            abort(404);
        }
        $loans = CoBorrower::with('loan.member.units.campuses', 'loan.loanApplicationStatus.loanApplicationState', 'loan.loanCategory')
        ->where('accept_request', 1)
        ->whereHas('loan', function($query) use ($loan_type_id) {
            $query->where('loan_type_id', $loan_type_id);
        })
        ->get();

        $loan_app_states = LoanApplicationState::all();
        $loan_categories = LoanCategory::all();


        $approved= 0;
        $denied = 0;
        $pending = 0;
        $years = [];
        foreach($loans as $loan){
            $date_requested = Carbon::parse($loan->loan->created_at)->year;
            array_push($years, $date_requested);
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
        $years = array_unique($years);
    
        $units = Unit::all();

        
        // dd($years);
        // initialize months for select filter
        $months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        
    

        return view('admin-views.admin-loan-applications-tracking.admin-loan-applications-tracking', compact(
            'loans', 
            'loan_app_states', 
            'loan_categories', 
            'approved' , 
            'denied', 
            'pending' ,
            'loan_type',
            'months',
            'years',
            'units',
            'loan_type'
        ));
    }



    public function createLoanApplicationStatus(Request $request, $loan_id){
        
        //Validate if loan exists
        $loan = Loan::findOrFail($loan_id);
        
        $amortization = Amortization::find($loan->amortization_id);
        
        

        if($request->loan_application_state_id == 5){
            if($amortization == null){
                return back()->with('status_danger', 'Please add amortization details first before adding "check picked up" status.');
            }
            elseif(is_null($amortization->amort_end)|| is_null($amortization->amort_start == null) || is_null($amortization->amort_principal) || is_null($amortization->amort_interest)){
                return back()->with('status_danger', 'Please make sure all details in amortization columns are filled out.');
            }elseif($loan->interest == null){
                return back()->with('status_danger', 'Please add the interest value of this loan first.');
            }
        }
     
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
