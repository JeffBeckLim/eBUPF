<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function show(){
        return view('member-views.your-loans.member-loans');
    }
}
