<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function show(){

        return view('member-views.calculator.calculator');
    }

    public function calculate(Request $request){
        $request->validate([
            'loan_category' => 'required',
            'amount' => 'required|numeric|min:50000|max:200000',
            'term' => 'required|numeric',
            'prevLoan' => 'nullable|numeric',
        ]);

        // Retrieve data from the form
        $loanCategory = $request->input('loan_category');
        $amount = $request->input('amount');
        $termYears = $request->input('term');
        $prevLoan = $request->input('prevLoan', 0); // Default to 0 if not provided

        // Calculate the interest rate based on the loan category. 6% for MPL, 9% for HSL
        if ($loanCategory == 'mpl') {
            $interestRate = 0.06;
        }
        else{
            $interestRate = 0.09;
        }

        // Calculate yearly principal balance
        $yearlyPrincipalBalance = $amount / $termYears;
        $yearlyBalance = $amount;
        $totalInterest = 0;

        // Initialize an array to store the yearly balances
        $yearlyBalances = [];

        // Calculate and store the yearly balances in the array
        for ($year = 0; $year < $termYears; $year++) {
            $yearlyInterest = $yearlyBalance * $interestRate;
            $totalInterest += $yearlyInterest;

            $yearlyBalances[$year] = [
                'yearlyBalance' => $yearlyBalance,
                'yearlyInterest' => $yearlyInterest,
            ];
            $yearlyBalance -= $yearlyPrincipalBalance;
        }

        // Sum of total Interest and Principal
        $totalInterestAndPrincipal = $amount + $totalInterest;

        //monthly amortization
        $monthlyAmort = $totalInterestAndPrincipal / ($termYears * 12);
        //make the monthlyAmort to 2 decimal places
        $monthlyAmort = number_format((float)$monthlyAmort, 2, '.', '');

        //monthly principal amortization without interest
        $monthlyPrincipalAmort = $amount / ($termYears * 12);
        $monthlyPrincipalAmort = number_format((float)$monthlyPrincipalAmort, 2, '.', '');

        //monthly principal Interest amortization
        $monthlyInterestAmort = $totalInterest / $termYears / 12;
        $monthlyInterestAmort = number_format((float)$monthlyInterestAmort, 2, '.', '');

        //total months
        $totalMonths = $termYears * 12;
        $percentageAmount = ($amount / ($amount + $totalInterest)) * 100;
        $percentageInterest = ($totalInterest / ($amount + $totalInterest)) * 100;

        return view('member-views.calculator.calculator')->with([
            'amount' => $amount,
            'yearlyPrincipalBalance' => $yearlyPrincipalBalance,
            'termYears' => $termYears,
            'yearlyBalances' => $yearlyBalances,
            'totalInterest' => $totalInterest,
            'monthlyAmort' => $monthlyAmort,
            'monthlyPrincipalAmort' => $monthlyPrincipalAmort,
            'monthlyInterestAmort' => $monthlyInterestAmort,
            'totalAmount'=> $totalInterestAndPrincipal,
            'totalMonths' => $totalMonths,
            'percentageAmount' => $percentageAmount,
            'percentageInterest' => $percentageInterest,
        ]);
    }
}
