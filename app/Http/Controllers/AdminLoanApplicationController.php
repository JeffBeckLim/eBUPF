<?php

namespace App\Http\Controllers;

use App\Models\CoBorrower;
use App\Models\Loan;
use App\Models\LoanApplicationState;
use App\Models\LoanApplicationStatus;
use Illuminate\Http\Request;

class AdminLoanApplicationController extends Controller
{
    // get all MPL loans and only loans that are accepted by CoBorrower
    public function showMplApplications(){
        $loans = CoBorrower::with('loan.member.units.campuses', 'loan.loanApplicationStatus') 
        ->whereHas('loan.member', function ($query) {
            $query->where('loan_type_id', 1)
                ->where('accept_request', '1');
        })->get();

        $loan_app_states = LoanApplicationState::all();
    
        return view('admin-views.admin-loan-applications.admin-mpl-applications', compact('loans', 'loan_app_states'));
    }

    public function showHslApplications(){
        return view('admin-views.admin-loan-applications.admin-hsl-applications');
    }

    public function createLoanApplicationStatus(Request $request, $loan_id){
        dd($loan_id);
        dd($request);
    }
}
