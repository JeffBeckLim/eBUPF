<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Check;
use Illuminate\Http\Request;
use GuzzleHttp\Promise\Create;

class CheckController extends Controller
{
    //
    public function updateCheck(Request $request, $id){
        
        $check = Check::where('loan_id', $id)->first();
        $loan = Loan::findOrFail($id)->first();
        // dd($loan);
        // ADD VALIDATIONS

        if( $check == null ){
            $check = Check::create([
                'loan_id'=>$loan->id,
                'date'=>$request->date,    
                'adjusted_net_pay'=>$request->adjusted_net_pay, 
                'remarks'=>$request->remarks,
                'check_co'=>$request->check_co,
            ]);

            return back()->with('success', 'Loan check created');
            
        }elseif( $check != null){

            $check->date=$request->date; 
            $check->adjusted_net_pay=$request->adjusted_net_pay; 
            $check->remarks=$request->remarks;
            $check->check_co=$request->check_co;
            $check->save();

            return back()->with('success', 'Loan check updated');
        }

    }
}
