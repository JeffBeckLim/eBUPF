<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanApplicationController extends Controller
{
    //
    public function show(){
        return view('member-views.loan-application-form');
    }
}
