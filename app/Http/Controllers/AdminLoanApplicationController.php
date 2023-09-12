<?php

namespace App\Http\Controllers;

use finfo;
use App\Models\Loan;
use App\Models\CoBorrower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\LoanApplicationState;
use App\Models\LoanApplicationStatus;

class AdminLoanApplicationController extends Controller
{
    // get all MPL loans and only loans that are accepted by CoBorrower
    public function showMplApplications(){
        $loans = CoBorrower::with('loan.member.units.campuses', 'loan.loanApplicationStatus') 
        ->whereHas('loan.member', function ($query) {
            $query->where('loan_type_id', 1)
                ->where('accept_request', '1');
        })->get();
        // $loans = CoBorrower::with('loan.member.units.campuses', 'loan.loanApplicationStatus')->get();
        $loan_app_states = LoanApplicationState::all();
    
        return view('admin-views.admin-loan-applications.admin-mpl-applications', compact('loans', 'loan_app_states'));
    }


    
    public function showHslApplications(){
        return view('admin-views.admin-loan-applications.admin-hsl-applications');
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
