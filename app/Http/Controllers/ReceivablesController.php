<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Unit;
use Carbon\Carbon;
use App\Models\Payment;

class ReceivablesController extends Controller
{
    public function show(Request $request) {
        // Get loans that have amortization
        $loans = Loan::whereHas('amortization')->get();

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

        // Calculate quarterly payments for each loan
        foreach ($loans as $loan) {
            $loanId = $loan->id;
            $quarterlyPayments[$loanId] = $this->calculateQuarterlyPayments($loanId);
            $quarterlyPaymentsForInterest[$loanId] = $this->calculateQuarterlyInterestPayments($loanId);
        }

        $currentYear = Carbon::now()->year;

        // Set the default selected year and unit
        $selectedYear = $request->input('yearSelect') ?? $currentYear;
        $selectedUnit = $request->input('unitSelect') ?? 'All';

        if ($request->has('clearFilterButton')) {
            $selectedYear = $currentYear;
            $selectedUnit = 'All';
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
                'quarterlyPaymentsForInterest'
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

}
