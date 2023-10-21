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
        $penalty = Penalty::find($loan->penalty_id);

        $formFields = $request->validate([
            'penalty_total'=> 'required|numeric|min:1',
        ]);
        if($penalty == null){
            $new_penalty = Penalty::create([
                'penalty_total' => $formFields['penalty_total'],
            ]);

            $loan->penalty_id = $new_penalty->id;
            $loan->save();

            return back()->with('passed', 'Penalty successfully added! ');

        }elseif($penalty != null){
            $penalty->penalty_total =  $formFields['penalty_total'];
            $penalty->save();
            return back()->with('passed', 'Penalty successfully updated! ');
        }
    }

    public function createPenaltyPayment(Request $request, $penalty_id){
        $penalty = Penalty::find($penalty_id);
        $loan = Loan::where('penalty_id', $penalty_id)->first();
        
        $formFields = $request->validate([
            'penalty_payment_amount'=> 'required|numeric|min:1',
            'payment_date'=>'required|date',
            'or_number'=>'nullable',
        ]);

        // check if penalty table exist
        if($penalty != null){
            $new_penalty_payment = PenaltyPayment::create([
                'penalty_payment_amount'=> $formFields['penalty_payment_amount'],
                'payment_date'=> $formFields['payment_date'],
                'member_id'=>$loan->member_id,
                'penalty_id'=>$penalty->id,
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
