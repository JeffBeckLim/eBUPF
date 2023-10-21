<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Unit;
use Carbon\Carbon;
use App\Models\Member;
use App\Models\CoBorrower;
use App\Models\Payment;

class AdminReceivablesController extends Controller
{
    public function show(Request $request, $report, $loan_type) {

        if($loan_type == 'mpl'){
            $loans = Loan::whereHas('amortization')->where('loan_type_id', 1)->get();
        }elseif($loan_type == 'hsl'){
            $loans = Loan::whereHas('amortization')->where('loan_type_id', 2)->get();
        }else{
            abort(404);
        }

        $units = Unit::all();

        $distinctYears = [];
        foreach ($loans as $loan) {
            $amortStartYear = Carbon::parse($loan->amortization->amort_start)->year;
            $amortEndYear = Carbon::parse($loan->amortization->amort_end)->year;

            // Add all years from amort_start to amort_end (inclusive) to the distinctYears array
            for ($year = $amortStartYear; $year <= $amortEndYear; $year++) {
                $distinctYears[] = $year;
            }
        }
        $distinctYears = array_unique($distinctYears);

        $currentYear = Carbon::now()->year;
        // Set the default selected year and unit
        $selectedYear = $request->input('yearSelect') ?? $currentYear;
        $selectedUnit = $request->input('unitSelect') ?? 'All';

        if ($request->has('clearFilterButton')) {
            $selectedYear = $currentYear;
            $selectedUnit = 'All';
        }

        // Define an array to store quarterly payments for each loan
        $quarterlyPayments = [];
        $quarterlyPaymentsForInterest = [];

        // Calculate quarterly payments for each loan
        foreach ($loans as $loan) {
            $loanId = $loan->id;
            $quarterlyPayments[$loanId] = $this->calculateQuarterlyPayments($loanId);
            $quarterlyPaymentsForInterest[$loanId] = $this->calculateQuarterlyInterestPayments($loanId);
        }


        $yearlyBalances = [];

        foreach ($loans as $loan) {
            $amortStartYear = Carbon::parse($loan->amortization->amort_start)->year;
            $amortEndYear = Carbon::parse($loan->amortization->amort_end)->year;

            $loanId = $loan->id;
            $yearlyBalances[$loanId] = [];

            for ($year = $amortStartYear; $year <= $amortEndYear; $year++) {
                if ($year == $amortStartYear) {
                    // First year, use loan's principal as beginning balance
                    $beginningBalancePrincipal = $loan->principal_amount;
                    $beginningBalanceInterest = $loan->interest;
                } else {
                    // Subsequent years, use the ending balance of the previous year
                    $beginningBalancePrincipal = $yearlyBalances[$loanId][$year - 1]['ending_balance_principal'];
                    $beginningBalanceInterest = $yearlyBalances[$loanId][$year - 1]['ending_balance_interest'];
                }

                // Calculate payments made in this year
                $paymentsInYearPrincipal = 0;
                $paymentsInYearInterest = 0;

                if (isset($quarterlyPayments[$loanId][$year])) {
                    $paymentsInYearPrincipal = array_sum($quarterlyPayments[$loanId][$year]);
                }

                $paymentsInYearInterest = 0;
                if (isset($quarterlyPaymentsForInterest[$loanId][$year])) {
                    $paymentsInYearInterest = array_sum($quarterlyPaymentsForInterest[$loanId][$year]);
                }

                $endingBalancePrincipal = $beginningBalancePrincipal - $paymentsInYearPrincipal;
                $endingBalanceInterest = $beginningBalanceInterest - $paymentsInYearInterest;

                $yearlyBalances[$loanId][$year] = [
                    'beginning_balance_principal' => $beginningBalancePrincipal,
                    'ending_balance_principal' => $endingBalancePrincipal,
                    'beginning_balance_interest' => $beginningBalanceInterest,
                    'ending_balance_interest' => $endingBalanceInterest,
                ];
            }
        }

        return view('admin-views.admin-receivables.admin-receivables',
            compact(
                'loans',
                'quarterlyPayments',
                'currentYear',
                'selectedYear',
                'selectedUnit',
                'units',
                'distinctYears',
                'yearlyBalances',
                'quarterlyPaymentsForInterest',
                'loan_type',
                'report'
            ));
    }

    // Function to calculate quarterly principal payments for a loan
    private function calculateQuarterlyPayments($loanId) {
        $payments = Payment::where('loan_id', $loanId)->get();

        $quarterlyPayments = [];

        foreach ($payments as $payment) {

            $paymentDate = $payment->payment_date;
            $quarter = ceil(date('n', strtotime($paymentDate)) / 3);
            $year = date('Y', strtotime($paymentDate));

            // Initialize the quarterly payment for the year if it doesn't exist
            if (!isset($quarterlyPayments[$year])) {
                $quarterlyPayments[$year] = [
                    // Quarters
                    1 => 0,
                    2 => 0,
                    3 => 0,
                    4 => 0,
                ];
            }

            // Add the principal amount to the corresponding quarter
            $quarterlyPayments[$year][$quarter] += $payment->principal;
        }

        return $quarterlyPayments;
    }

    // Function to calculate quarterly interest payments for a loan
    private function calculateQuarterlyInterestPayments($loanId) {
        $payments = Payment::where('loan_id', $loanId)->get();

        $quarterlyPayments = [];

        foreach ($payments as $payment) {
            $paymentDate = $payment->payment_date;
            $quarter = ceil(date('n', strtotime($paymentDate)) / 3);
            $year = date('Y', strtotime($paymentDate));

            // Initialize the quarterly payment for the year if it doesn't exist
            if (!isset($quarterlyPayments[$year])) {
                $quarterlyPayments[$year] = [
                    // Quarters
                    1 => 0,
                    2 => 0,
                    3 => 0,
                    4 => 0,
                ];
            }

            // Add the interest payment amount to the corresponding quarter
            $quarterlyPayments[$year][$quarter] += $payment->interest;
        }

        return $quarterlyPayments;
    }

    public function summary(Request $request, $report, $loan_type)
    {
        if ($loan_type == 'mpl') {
            $loans = Loan::whereHas('amortization')->where('loan_type_id', 1)->get();
        } elseif ($loan_type == 'hsl') {
            $loans = Loan::whereHas('amortization')->where('loan_type_id', 2)->get();
        } else {
            abort(404); // Invalid loan type
        }

        $units = Unit::all();

        $distinctYears = [];
        foreach ($loans as $loan) {
            $amortStartYear = Carbon::parse($loan->amortization->amort_start)->year;
            $amortEndYear = Carbon::parse($loan->amortization->amort_end)->year;

            // Add all years from amort_start to amort_end (inclusive) to the distinctYears array
            for ($year = $amortStartYear; $year <= $amortEndYear; $year++) {
                $distinctYears[] = $year;
            }
        }
        $distinctYears = array_unique($distinctYears);

        $currentYear = Carbon::now()->year;
        // Define an array to store quarterly payments for each loan
        $quarterlyPayments = [];
        $quarterlyPaymentsForInterest = [];

        // Calculate quarterly payments for each loan
        foreach ($loans as $loan) {
            $loanId = $loan->id;
            $quarterlyPayments[$loanId] = $this->calculateQuarterlyPayments($loanId);
            $quarterlyPaymentsForInterest[$loanId] = $this->calculateQuarterlyInterestPayments($loanId);
        }
        // Set the default selected year and unit
        $selectedYear = $request->input('yearSelect') ?? $currentYear;

        if ($request->has('clearFilterButton')) {
            $selectedYear = $currentYear;
        }

        $yearlyBalances = [];
        $combinedYearlyBalances = []; // To store combined yearly balances(ending) for units

        foreach ($loans as $loan) {
            $amortStartYear = Carbon::parse($loan->amortization->amort_start)->year;
            $amortEndYear = Carbon::parse($loan->amortization->amort_end)->year;

            $loanId = $loan->id;
            $unitCode = $loan->member->units->unit_code; // Get the unit code

            // Initialize the combined yearly balances for the unit if it doesn't exist
            if (!isset($combinedYearlyBalances[$unitCode])) {
                $combinedYearlyBalances[$unitCode] = [];
            }

            $yearlyBalances[$loanId] = [];

            // Calculate yearly balances for the loan
            for ($year = $amortStartYear; $year <= $amortEndYear; $year++) {
                if ($year == $amortStartYear) {
                    // First year, use loan's principal as beginning balance
                    $beginningBalancePrincipal = $loan->principal_amount;
                    $beginningBalanceInterest = $loan->interest;
                } else {
                    // Subsequent years, use the ending balance of the previous year
                    $beginningBalancePrincipal = $yearlyBalances[$loanId][$year - 1]['ending_balance_principal'];
                    $beginningBalanceInterest = $yearlyBalances[$loanId][$year - 1]['ending_balance_interest'];
                }

                // Calculate payments made in this year
                $paymentsInYearPrincipal = 0;
                $paymentsInYearInterest = 0;

                if (isset($quarterlyPayments[$loanId][$year])) {
                    $paymentsInYearPrincipal = array_sum($quarterlyPayments[$loanId][$year]);
                }

                $paymentsInYearInterest = 0;
                if (isset($quarterlyPaymentsForInterest[$loanId][$year])) {
                    $paymentsInYearInterest = array_sum($quarterlyPaymentsForInterest[$loanId][$year]);
                }

                $endingBalancePrincipal = $beginningBalancePrincipal - $paymentsInYearPrincipal;
                $endingBalanceInterest = $beginningBalanceInterest - $paymentsInYearInterest;

                $yearlyBalances[$loanId][$year] = [
                    'beginning_balance_principal' => $beginningBalancePrincipal,
                    'ending_balance_principal' => $endingBalancePrincipal,
                    'beginning_balance_interest' => $beginningBalanceInterest,
                    'ending_balance_interest' => $endingBalanceInterest,
                ];

                // Update the combined yearly balances for the unit
                if (!isset($combinedYearlyBalances[$unitCode][$year])) {
                    $combinedYearlyBalances[$unitCode][$year] = [
                        'beginning_balance_principal' => 0,
                        'ending_balance_principal' => 0,
                        'beginning_balance_interest' => 0,
                        'ending_balance_interest' => 0,
                    ];
                }

                $combinedYearlyBalances[$unitCode][$year]['beginning_balance_principal'] += $beginningBalancePrincipal;
                $combinedYearlyBalances[$unitCode][$year]['ending_balance_principal'] += $endingBalancePrincipal;
                $combinedYearlyBalances[$unitCode][$year]['beginning_balance_interest'] += $beginningBalanceInterest;
                $combinedYearlyBalances[$unitCode][$year]['ending_balance_interest'] += $endingBalanceInterest;
            }
        }

        return view('admin-views.admin-receivables.admin-receivables-summary', compact(
            'report',
            'loan_type',
            'loans',
            'yearlyBalances',
            'units',
            'distinctYears',
            'selectedYear',
            'combinedYearlyBalances'
        ));
    }


    public function remit(Request $request, $report, $loan_type){

        if ($loan_type == 'mpl') {
            $loans = Loan::whereHas('amortization')->where('loan_type_id', 1)->get();
        } elseif ($loan_type == 'hsl') {
            $loans = Loan::whereHas('amortization')->where('loan_type_id', 2)->get();
        } else {
            abort(404); // Invalid loan type
        }

        $units = Unit::all();

        $distinctYears = [];

        foreach ($loans as $loan) {
            $amortStartYear = Carbon::parse($loan->amortization->amort_start)->year;
            $amortEndYear = Carbon::parse($loan->amortization->amort_end)->year;

            // Add all years from amort_start to amort_end (inclusive) to the distinctYears array
            for ($year = $amortStartYear; $year <= $amortEndYear; $year++) {
                $distinctYears[] = $year;
            }
        }
        $distinctYears = array_unique($distinctYears);

        $currentYear = Carbon::now()->year;
        // Set the default selected year and unit
        $selectedYear = $request->input('yearSelect') ?? $currentYear;
        $selectedUnit = $request->input('unitSelect') ?? 'All';

        if ($request->has('clearFilterButton')) {
            $selectedYear = $currentYear;
            $selectedUnit = 'All';
        }

        // Create an array to store members and their payments
        $membersWithPayments = [];
        // Iterate through units and their members
        foreach ($units as $unit) {
            $members = $unit->members;

            // Iterate through members of the unit
            foreach ($members as $member) {
                // Check if the member has any loans for the selected year
                $memberLoans = $loans->filter(function ($loan) use ($member, $selectedYear) {
                    $payments = Payment::where('loan_id', $loan->id)
                        ->where('member_id', $member->id)
                        ->whereYear('payment_date', $selectedYear)
                        ->exists();
                    return $payments;
                });

                // Collect information about the member only if they have loans and payments
                if ($memberLoans->isNotEmpty()) {
                    $memberInfo = [
                        'unit_name' => $unit->unit_code,
                        'member_name' => $member->lastname . ', ' . $member->firstname,
                        'member_loans' => [],
                    ];

                    // Iterate through loans for this member
                    foreach ($memberLoans as $loan) {
                        // Filter the payments related to this loan and member
                        $payments = Payment::where('loan_id', $loan->id)
                            ->where('member_id', $member->id)
                            ->whereYear('payment_date', $selectedYear)
                            ->get();

                        // Store the principal, interest, and total payments for this loan
                        $monthlyPayments = $payments->groupBy(function ($payment) {
                            return Carbon::parse($payment->payment_date)->format('F Y');
                        })->map(function ($payments) {
                            return [
                                'principal' => $payments->sum('principal'),
                                'interest' => $payments->sum('interest'),
                                'total' => $payments->sum('principal') + $payments->sum('interest'),
                            ];
                        });

                        // Store the member's payments for this loan
                        $memberInfo['member_loans'][] = [
                            'loan_name' => $loan_type == 'mpl' ? 'MPL ' . $loan->id : 'HSL ' . $loan->id,
                            'monthly_payments' => $monthlyPayments,
                        ];
                    }

                    // Add the member's information to the array
                    $membersWithPayments[] = $memberInfo;
                }
            }
        }

        return view('admin-views.admin-receivables.admin-receivables-remit', compact(
            'report',
            'loan_type',
            'currentYear',
            'selectedYear',
            'selectedUnit',
            'units',
            'distinctYears',
            'membersWithPayments'
        ));
    }
}
