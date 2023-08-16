<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanApplicationController extends Controller
{
    //
    public function show(){
        return view('member-views.mpl-application-form.mpl-application-form');
    }
    public function storeRequest(Request $request){
       
        $formFields = $request->validate([

            'principal_amount'=> ['required', 'numeric', 'min:50000', 'max:200000'],
            'term_years'=> ['required', 'numeric', 'min:1', 'max:5'],
            'coBorrower_id'=> 'required',
            'wittness_1'=> 'required',
            'wittness_2'=> 'required',
        ]);

        dd($formFields);
    }
}
