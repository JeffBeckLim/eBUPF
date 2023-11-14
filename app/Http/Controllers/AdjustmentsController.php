<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Adjustment;
use Illuminate\Http\Request;
use App\Models\AdjustmentLog;
use Illuminate\Support\Facades\Auth;

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

            // create log
            $adjustment_add_log = AdjustmentLog::create([
                'loan_id_log'=>$loan->id,
                'loan_code_log'=>$loan->loan_code,
        
                'adjustments_id_log'=>$adjustment->id,
                'log_col_name'=>"Create",
                'changes'=>"None",
                'updated_by'=>Auth::user()->member->id
    
            ]);
           

            return back()->with('success', 'ADJUSTMENTS: Adjustments added');
        }
        elseif($loan->adjustment_id != null){
            $adjustment = Adjustment::findOrFail($loan->adjustment_id);
            // $old_adjustment = Adjustment::findOrFail($loan->adjustment_id);

            // check for changes, true has changes, else false. 
            $changes = $this->check_changes($request, $adjustment);
            if($changes == false){
                return back();
            }
            // create log and save changes
            $this->save_and_log($adjustment , $request, $loan);
            

            return back()->with('success', 'ADJUSTMENTS: Adjustments updated');
        }

    }
    // check if any data is changed during update
    public function check_changes($request, $adjustment){
        if ($adjustment->mri == $request->mri&&
        $adjustment->interest_rebate  == $request->interest_rebate&&
        $adjustment->previous_loan_balance == $request->previous_loan_balance&&
        $adjustment->interest_first_yr == $request->interest_first_yr&&
        $adjustment->previous_penalty == $request->previous_penalty&&
        $adjustment->housing_service_fee == $request->housing_service_fee) {
                return false;
        }else{
            return true;
        }
    }


    // log and save
    public function save_and_log($adjustment , $request, $loan){
        $old_adjustment = $adjustment;
            // dd($old_adjustment)
            $changed_cols = [];
            if($adjustment->mri != $request->mri){
                $adjustment->mri = $request->mri;
                array_push($changed_cols, "MRI: ".$old_adjustment->mri."->".$request->mri);
            }
            if( $adjustment->interest_rebate  != $request->interest_rebate){
                $adjustment->interest_rebate  = $request->interest_rebate;
                array_push($changed_cols, "REBATE: ".$old_adjustment->interest_rebate."->".$request->interest_rebate);
            }
            if($adjustment->previous_loan_balance != $request->previous_loan_balance){
                $adjustment->previous_loan_balance = $request->previous_loan_balance;
                array_push($changed_cols, "PREV_BAL: ".$old_adjustment->previous_loan_balance."->".$request->previous_loan_balance);
            }
           if($adjustment->interest_first_yr != $request->interest_first_yr) {
                $adjustment->interest_first_yr = $request->interest_first_yr;
                array_push($changed_cols, "INT_1st: ".$old_adjustment->interest_first_yr."->".$request->interest_first_yr);
           }
            if($adjustment->housing_service_fee != $request->housing_service_fee){
                $adjustment->housing_service_fee = $request->housing_service_fee;
                array_push($changed_cols, "SVC-FEE: ".$old_adjustment->housing_service_fee."->".$request->housing_service_fee);
            }
            if($adjustment->previous_penalty != $request->previous_penalty){
                $adjustment->previous_penalty = $request->previous_penalty;
                array_push($changed_cols, "PENALTY: ".$old_adjustment->previous_penalty."->".$request->previous_penalty);
            }
            $adjustment->save();

            $adjustment_update_log = AdjustmentLog::create([
                'loan_id_log'=>$loan->id,
                'loan_code_log'=>$loan->loan_code,
        
                'adjustments_id_log'=>$adjustment->id,
                'log_col_name'=>"Update",
                'changes'=>implode(", " , $changed_cols),
                'updated_by'=>Auth::user()->member->id
    
            ]);

    }
}
