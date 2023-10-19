<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Penalty;
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
}
