<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Loan;
use App\Models\Amortization;
use Illuminate\Http\Request;
use GuzzleHttp\Promise\Create;

class AdminAmortizationController extends Controller
{
    public function createAmortization(Request $request, $id){
        $loan = Loan::findOrFail($id);
        
        $request->validate([
            'amort_principal'=> 'required|numeric|min:300|max:200000',
            'amort_interest'=> 'required|numeric|min:100|max:200000',
            'amort_start'=> 'nullable|date',
            'amort_end'=> 'nullable|date',
        ]);

        $startDate = Carbon::parse($request->amort_start);
        $endDate = Carbon::parse($request->amort_end);

        $dateError = 0;
        $dateMatchError = 0;
        if($startDate == null || $endDate == null){

        }
        // get years if it is Greater
        elseif
        ($endDate->greaterThan($startDate)){
            $diffInMonths = $startDate->diffInMonths($endDate);
            $diffInYears = ceil($diffInMonths / 12);
            
            if($diffInYears != $loan->term_years){
                $dateMatchError = 1;
            }
        }else{
            $dateError = 1;
        } 
        // the term does not match the LOAN TERM
        

        // $diffInYears = $startDate->diffInMonths($endDate)+1;
        

        // for new amortization
        if($loan->amortization_id == null){
            $amortization = Amortization::create([
                'amort_principal' => $request->amort_principal, 
                'amort_interest' => $request->amort_interest, 
                'amort_start' => $request->amort_start, 
                'amort_end' => $request->amort_end,

            ]);
            $loan->amortization_id = $amortization->id;
            $loan->save();
        }
        // for updating amortizations
        elseif($loan->amortization_id != null){
            $loan_amortization = Amortization::findOrFail($loan->amortization_id);
            
            $loan_amortization->amort_principal = $request->amort_principal; 
            $loan_amortization->amort_interest = $request->amort_interest;
            $loan_amortization->amort_start = $request->amort_start;
            $loan_amortization->amort_end = $request->amort_end;
            $loan_amortization->save();
            
        }

        if($dateError == 1 && $dateMatchError == 1){
            return back()->with('amort_success', 'Amortization Added!')
            ->with('date_error', 'Amortization period, start date is greater than the end date')
            ->with('dateMatchError', 'The amort period does not match the Loan Term');    
        }elseif($dateError == 1){
            return back()->with('amort_success', 'Amortization Added!')->with('date_error', 'End date is less than the start date');    
        }elseif($dateMatchError == 1){
            return back()->with('amort_success', 'Amortization Added!')->with('dateMatchError', 'The amort. period does not match the Loan Term');
        }

        return back()->with('amort_success', 'Amortization Updated!');
    }
}
