<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Unit;
use App\Models\CoBorrower;
use App\Models\LoanCategory;
use Illuminate\Http\Request;
use App\Models\LoanApplicationState;

class AJAXAdminTrackingController extends Controller
{
    public function get($loan_type){
        $loan_type = 'mpl';
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

        // return view('admin-views.admin-loan-applications-tracking.admin-loan-applications-tracking', compact(
        //     'loans',
        //     'loan_app_states',
        //     'loan_categories',
        //     'approved' ,
        //     'denied',
        //     'pending' ,
        //     'loan_type',
        //     'months',
        //     'years',
        //     'units',
        //     'loan_type'
        // ));

        return response()->json([
            'loans' => $loans,
            'loan_app_states' => $loan_app_states,
            'loan_categories'=> $loan_categories,
            'approved' => $approved,
            'denied'=> $denied,
            'pending' => $pending,
            'loan_type'=> $loan_type,
            'months'=> $months,
            'years'=> $years,
            'units'=> $units,
        ]);
    }
}
