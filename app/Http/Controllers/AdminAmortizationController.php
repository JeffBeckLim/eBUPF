<?php

namespace App\Http\Controllers;

use App\Models\Amortization;
use App\Models\Loan;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;

class AdminAmortizationController extends Controller
{
    public function createAmortization(Request $request, $id){
        $loan = Loan::findOrFail($id);
    
        if($loan->amortization_id == null){
            $amortization = Amortization::create([
                'amort_principal' => $request->amort_principal, 
                'amort_interest' => $request->amort_interest, 
                'amort_start' => $request->amort_start, 
                'amort_end' => $request->amort_end, 
            ]);
        }

        $loan->amortization_id = $amortization->id;
        $loan->save();

        return back()->with('amort_success', 'Amortization Added!');
    }
}
