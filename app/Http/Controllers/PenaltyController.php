<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Penalty;
use App\Models\PenaltyPayment;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class PenaltyController extends Controller
{
    public function updatePenalty(Request $request, $id){

        $loan = Loan::findOrFail($id);

        $formFields = $request->validate([
            'penalty_total'=> 'required|numeric|min:1',
            'penalized_month'=> 'required|integer|min:1',
            'penalized_year'=> 'required|integer|min:1'
        ]);
        
         $mandatory = Penalty::create([
                'loan_id'=>$loan->id,
                'penalty_total' => $formFields['penalty_total'],
                'penalized_month' => $formFields['penalized_month'],
                'penalized_year' => $formFields['penalized_year']
            ]);

            
        return back()->with('passed', 'Penalty successfully added! ');
    }

    public function createPenaltyPayment(Request $request){
        $formFields = $request->validate([
            'penalty_payment_amount'=> 'required|numeric|min:1',
            'penalty_id'=>'required',
            'or_number'=>'nullable',
            'payment_date'=>'nullable'
        ]);

        $penalty = Penalty::where('id', $formFields['penalty_id'])->first();

        $new_penalty_payments = PenaltyPayment::where('penalty_id' , $penalty->id)->sum('penalty_payment_amount');

        $penalty_balance = $penalty->penalty_total - $new_penalty_payments;
        
        if($formFields['penalty_payment_amount'] > $penalty_balance){
            return back()->with('warning', 'Cannot add payment greater than remaining balance');
        }


        $loan = Loan::where('id',$penalty->loan_id)->first();
        if($penalty == null && $loan == null){
            abort(403);
        }
        // check if penalty table exist
        if($penalty != null){
            $new_penalty_payment = PenaltyPayment::create([
                'member_id'=>$loan->member_id,
                'penalty_id'=>$penalty->id,
                'penalty_payment_amount'=> $formFields['penalty_payment_amount'],
                
                'payment_date'=> $formFields['payment_date'],
                'or_number'=>$formFields['or_number'],
            ]);
            
            return back()->with('passed', 'Penalty Payment Added');

        }else{
            abort(404);
        }
    }

    public function updatePenaltyPayment(Request $request, $penaltyPayment_id){
        $penaltyPayment = PenaltyPayment::findOrFail($penaltyPayment_id);

        $formFields = $request->validate([
            'penalty_payment_amount'=> 'required|numeric|min:1',
            'payment_date'=>'required|date',
            'or_number'=>'nullable',
        ]);

        if($penaltyPayment != null){
            
            $penaltyPayment->penalty_payment_amount = $formFields['penalty_payment_amount'];
            $penaltyPayment->payment_date = $formFields['payment_date'];
            $penaltyPayment->or_number = $formFields['or_number'];
            $penaltyPayment->save();

            return back()->with('passed', 'Penalty Payment Updated');

        }else{
            abort(404);
        }
    }
}
