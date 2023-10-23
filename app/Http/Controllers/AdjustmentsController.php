<?php

namespace App\Http\Controllers;

use App\Models\Adjustment;
use App\Models\Loan;
use Illuminate\Http\Request;

class AdjustmentsController extends Controller
{
    public function updateLoanAdjustments(Request $request, $id){

        $request->validate([
            'mri'=> 'nullable|numeric|min:0',
            'interest_rebate'=> 'nullable|numeric|min:0',
            'previous_loan_balance'=> 'nullable|numeric|min:0',
            'interest_first_yr'=> 'nullable|numeric|min:0',
            'housing_service_fee'=> 'nullable|numeric|min:0',
            'previous_penalty' => 'nullable|numeric|min:0',
        ]);

        $loan = Loan::findOrFail($id);

        if($loan->adjustment_id == null){
            $adjustment = Adjustment::create([
                'mri'=> $request->mri,
                'interest_rebate'=> $request->interest_rebate,
                'previous_loan_balance'=> $request->previous_loan_balance,
                'interest_first_yr'=> $request->interest_first_yr,
                'housing_service_fee'=> $request->housing_service_fee,
                'previous_penalty' => $request->previous_penalty,
            ]);

            $loan->adjustment_id = $adjustment->id;
            $loan->save();

            return back()->with('success', 'ADJUSTMENTS: Adjustments added');
        }
        elseif($loan->adjustment_id != null){
            $adjustment = Adjustment::findOrFail($loan->adjustment_id);
            $adjustment->mri = $request->mri;
            $adjustment->interest_rebate  = $request->interest_rebate;
            $adjustment->previous_loan_balance = $request->previous_loan_balance;
            $adjustment->interest_first_yr = $request->interest_first_yr;
            $adjustment->housing_service_fee = $request->housing_service_fee;
            $adjustment->save();

            return back()->with('success', 'ADJUSTMENTS: Adjustments updated');
        }

    }
}
