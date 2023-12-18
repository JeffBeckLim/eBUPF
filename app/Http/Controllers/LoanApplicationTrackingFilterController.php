<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Unit;
use App\Models\CoBorrower;
use App\Models\LoanCategory;
use Illuminate\Http\Request;
use App\Models\LoanApplicationState;

class LoanApplicationTrackingFilterController extends Controller
{
    
    public function show(Request $request, $loan_type){

        if($request->query('year_filter') == 0 && 
        $request->query('month_filter') == 0 &&
        $request->query('unit_filter') == 0 
        ){
            
            return redirect()->route('admin.loan.applications.tracking', $loan_type);
        }

        if($loan_type == 'mpl'){
            $loan_type_id = 1;
        }elseif($loan_type == 'hsl'){
            $loan_type_id = 2;
        }else{
            abort(404);
        }
        $unfilteredLoans = CoBorrower::with('loan.member.units.campuses', 'loan.loanApplicationStatus.loanApplicationState', 'loan.loanCategory')
        ->where('accept_request', 1)
        ->whereHas('loan', function($query) use ($loan_type_id) {
            $query->where('loan_type_id', $loan_type_id);
        })
        ->get();
        // get distinct years
        $years = [];
        foreach($unfilteredLoans as $unfilteredLoan){
            $date_requested = Carbon::parse($unfilteredLoan->loan->created_at)->year;
            array_push($years, $date_requested);
            $years = array_unique($years);
        }   

        // Filtering
        $loans = [];
        foreach($unfilteredLoans as $unfilteredLoan){
            $year_flag = 1;
            $month_flag = 1;
            $unit_flag = 1;
            if($request->query('year_filter') != 0){
                if($request->query('year_filter') != Carbon::parse($unfilteredLoan->loan->created_at)->year){
                    $year_flag = 0;
                }
            }
            if($request->query('month_filter') != 0){
                if($request->query('month_filter') != Carbon::parse($unfilteredLoan->loan->created_at)->month){
                    $month_flag = 0;
                }
            }
            if($request->query('unit_filter') != 0){
                if($request->query('unit_filter') != $unfilteredLoan->loan->member->units->id){
                    $unit_flag = 0;
                }
            }
            if($year_flag == 1 && $month_flag == 1 && $unit_flag == 1){
                array_push($loans, $unfilteredLoan);
            }
        }
        $year_selected = $request->query('year_filter');
        $month_selected = $request->query('month_filter');
        $unit_selected = $request->query('unit_filter');


        $loan_app_states = LoanApplicationState::all();
        $loan_categories = LoanCategory::all();
    
        // counting
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
    
        $units = Unit::all();


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
            'loan_type',
            'year_selected',
            'month_selected',
            'unit_selected'
        ));

        
    }
  
}
