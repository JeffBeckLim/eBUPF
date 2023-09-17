<?php

namespace App\Http\Controllers;

use finfo;
use App\Models\Loan;
use App\Models\CoBorrower;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\LoanApplicationState;
use App\Models\LoanApplicationStatus;

class AdminLoanApplicationController extends Controller
{

    public function createLoanApplicationState(Request $request, $id){
    
        $loan = Loan::findOrFail($id);
        $loan->is_active =$request->is_active;
        $loan->save();

        return back()->with('state_update', 'Loan State Updated');
    }

    public function deleteLoanStatus($id){
        

        $status = LoanApplicationStatus::findOrFail($id);
        // $status->is_deleted = 1;
        $status->delete();

        return redirect('/admin/loan-applications/mpl')->with('deleted_status', 'Status deleted'); 
        
    }

    // get all MPL or HSL loan applications that are accepted by CoBorrower
    public function showLoanApplicationsTracking($loan_type){
        if($loan_type == 'mpl'){

            $loans = CoBorrower::with('loan.member.units.campuses', 'loan.loanApplicationStatus.loanApplicationState')
            ->where('accept_request', 1)
            ->whereHas('loan', function($query){
                $query->where('loan_type_id',  1); //loan type of MPL
            })->get();

        }elseif($loan_type == 'hsl'){

            $loans = CoBorrower::with('loan.member.units.campuses', 'loan.loanApplicationStatus.loanApplicationState')
            ->where('accept_request', 1)
            ->whereHas('loan', function($query){
                $query->where('loan_type_id',  2); //loan type of HSL
            })->get();

        }else{
            abort(404);
        }
        
        $loan_app_states = LoanApplicationState::all();
        

        $approved= 0;
        $denied = 0;
        $pending = 0;
        foreach($loans as $loan){
            if(count($loan->loan->loanApplicationStatus) < 0){
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
        

        if($loan_type == 'mpl'){
            return view('admin-views.admin-loan-applications-tracking.admin-mpl-applications-tracking', compact('loans', 'loan_app_states' ,'approved' , 'denied', 'pending' ,'loan_type'));
        }elseif($loan_type == 'hsl'){
            return view('admin-views.admin-loan-applications-tracking.admin-hsl-applications-tracking', compact('loans', 'loan_app_states'  ,'approved' , 'denied', 'pending' ,'loan_type'));            
        }else{
            abort(404);
        }
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
            return redirect('/admin/loan-applications/mpl')->with('status_error', 'The loan already has that status.');
        }

        $new_loan_status = LoanApplicationStatus::create([
            'loan_id' => $loan->id,
            'loan_application_state_id' => $formFields['loan_application_state_id'],
            'date_evaluated'=>$formFields['date_evaluated'],
            'remarks'=>$formFields['remarks'], 
        ]);
        
        return redirect('/admin/loan-applications/mpl')->with('success', 'New status added successfully!'); 
    }
}
