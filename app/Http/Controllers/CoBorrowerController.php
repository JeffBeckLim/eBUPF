<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\CoBorrower;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoBorrowerController extends Controller
{
    //
    public function show(){

        $requests = CoBorrower::with('Loan')->where('member_id', Auth::user()->member->id)->get();

        // $requests = CoBorrower::with('Loan', 'member')->where('member_id', Auth::user()->member->id)->get();

        dd($requests);
        return view('member-views.coborrower-requests', compact('requests'));
    }
}
