<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Loan;
use App\Models\Unit;
use App\Models\LoanCategory;
use Illuminate\Http\Request;

class LoanApplicationsFilterController extends Controller
{
    public function show(Request $request, $loanType ,$table_freeze){

        if($request->query('year_filter') == 0 && 
        $request->query('month_filter') == 0 &&
        $request->query('unit_filter') == 0 
        ){
            return redirect()->route('admin.loan.applications' , ['loanType' => $loanType, 'freeze' => $table_freeze]);
        }
            

        $raw_loans = Loan::with('member.units' , 'loanApplicationStatus.loanApplicationState' , 'loanCategory', 'amortization', 'adjustment', 'check', 'penalty')->has('loanApplicationStatus')
        ->where('loan_type_id', $loanType)
        ->get();
        $unfilteredLoans = [];
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
                array_push($unfilteredLoans, $raw_loan);
            }
        }

        // Filtering
        $loans = [];
        foreach($unfilteredLoans as $unfilteredLoan){
            $year_flag = 1;
            $month_flag = 1;
            $unit_flag = 1;
            if($request->query('year_filter') != 0){
                if($request->query('year_filter') != Carbon::parse($unfilteredLoan->created_at)->year){
                    $year_flag = 0;
                }
            }
            if($request->query('month_filter') != 0){
                if($request->query('month_filter') != Carbon::parse($unfilteredLoan->created_at)->month){
                    $month_flag = 0;
                }
            }
            if($request->query('unit_filter') != 0){
                if($request->query('unit_filter') != $unfilteredLoan->member->units->id){
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
        foreach ($raw_loans as $raw_loan) {
            $date_requested = Carbon::parse($raw_loan->created_at)->year;
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
            'year_selected',
            'month_selected',
            'unit_selected',          
            )
            ) ;
    }
}
