<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Payment;
use App\Models\Loan;
use App\Models\PenaltyPayment;
use Illuminate\Support\Collection;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function show(){
        $transactionPayments = Payment::where('member_id', Auth::user()->member->id)->get();
        $transactionLoans = Loan::where('member_id', Auth::user()->member->id)->get();
        $transactionPenaltyPayment = PenaltyPayment::where('member_id', Auth::user()->member->id)->get();

        //combine transactions
        $combinedTransactions = Collection::empty()
            ->merge($transactionPayments)
            ->merge($transactionLoans)
            ->merge($transactionPenaltyPayment);

        $transactions = $combinedTransactions->sortByDesc('created_at');

        //check if there are transactions
        return view('member-views.transactions.member-transactions', [
            'transactions' => $transactions,
        ]);
    }
}
