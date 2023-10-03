<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoanController extends Controller
{
    public function show(){
        $loans = Loan::where('member_id', Auth::user()->member->id)
            ->with('loanType' , 'payment','amortization')
            ->get();
        // dd($loans);

        return view('member-views.your-loans.member-loans', compact('loans'));
    }
}
