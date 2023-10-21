<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;
use App\Models\Loan;
use App\Models\Unit;
use Carbon\Carbon;
use App\Models\Payment;

class AdminReceivablesPDFController extends Controller{

    public function generateReceivablesSummary($year, $loan_type) {
        // Use the $year parameter to set the PDF name
        $lastMonth = 'December';
        $lastDay = '31';
        $pdfName = $lastMonth . ' ' . $lastDay . ', ' . $year . ' Summary.pdf';
        $type = '';

        if ($loan_type == 'mpl') {
            $loans = Loan::whereHas('amortization')->where('loan_type_id', 1)->get();
            $type = 'Multi-Purpose Loan';
        } elseif ($loan_type == 'hsl') {
            $loans = Loan::whereHas('amortization')->where('loan_type_id', 2)->get();
            $type = 'Housing Loan';
        } else {
            abort(404); // Invalid loan type
        }

        // Filter loans for the specified year
    $filteredLoans = $loans->filter(function ($loan) use ($year) {
        $amortStartYear = Carbon::parse($loan->amortization->amort_start)->year;
        $amortEndYear = Carbon::parse($loan->amortization->amort_end)->year;

        return $year >= $amortStartYear && $year <= $amortEndYear;
    });

    $quarterlyPayments = [];
    $quarterlyPaymentsForInterest = [];
    $yearlyBalances = [];
    $combinedYearlyBalances = []; // to store combined balances of every unit

    foreach ($filteredLoans as $loan) {
        $loanId = $loan->id;
        $quarterlyPayments[$loanId] = $this->calculateQuarterlyPayments($loanId);
        $quarterlyPaymentsForInterest[$loanId] = $this->calculateQuarterlyInterestPayments($loanId);
    }
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
            for ($yearly = $amortStartYear; $yearly <= $amortEndYear; $yearly++) {

                if ($yearly == $amortStartYear) {
                    // First year, use loan's principal as beginning balance
                    $beginningBalancePrincipal = $loan->principal_amount;
                    $beginningBalanceInterest = $loan->interest;
                } else {
                    // Subsequent years, use the ending balance of the previous year
                    $beginningBalancePrincipal = $yearlyBalances[$loanId][$yearly - 1]['ending_balance_principal'];
                    $beginningBalanceInterest = $yearlyBalances[$loanId][$yearly - 1]['ending_balance_interest'];
                }

                // Calculate payments made in this year
                $paymentsInYearPrincipal = 0;
                $paymentsInYearInterest = 0;

                if (isset($quarterlyPayments[$loanId][$yearly])) {
                    $paymentsInYearPrincipal = array_sum($quarterlyPayments[$loanId][$yearly]);
                }

                $paymentsInYearInterest = 0;
                if (isset($quarterlyPaymentsForInterest[$loanId][$yearly])) {
                    $paymentsInYearInterest = array_sum($quarterlyPaymentsForInterest[$loanId][$yearly]);
                }

                $endingBalancePrincipal = $beginningBalancePrincipal - $paymentsInYearPrincipal;
                $endingBalanceInterest = $beginningBalanceInterest - $paymentsInYearInterest;

                $yearlyBalances[$loanId][$yearly] = [
                    'beginning_balance_principal' => $beginningBalancePrincipal,
                    'ending_balance_principal' => $endingBalancePrincipal,
                    'beginning_balance_interest' => $beginningBalanceInterest,
                    'ending_balance_interest' => $endingBalanceInterest,
                ];

                // Update the combined yearly balances for the unit
                if (!isset($combinedYearlyBalances[$unitCode][$yearly])) {
                    $combinedYearlyBalances[$unitCode][$yearly] = [
                        'beginning_balance_principal' => 0,
                        'ending_balance_principal' => 0,
                        'beginning_balance_interest' => 0,
                        'ending_balance_interest' => 0,
                    ];
                }

                $combinedYearlyBalances[$unitCode][$yearly]['beginning_balance_principal'] += $beginningBalancePrincipal;
                $combinedYearlyBalances[$unitCode][$yearly]['ending_balance_principal'] += $endingBalancePrincipal;
                $combinedYearlyBalances[$unitCode][$yearly]['beginning_balance_interest'] += $beginningBalanceInterest;
                $combinedYearlyBalances[$unitCode][$yearly]['ending_balance_interest'] += $endingBalanceInterest;
            }
        }

        // pass the year to the view
        $data = [
            'lastMonth' => $lastMonth,
            'lastDay' => $lastDay,
            'year' => $year,
            'loans' => $loans,
            'yearlyBalances' => $yearlyBalances,
            'units' => Unit::all(),
            'combinedYearlyBalances' => $combinedYearlyBalances,
            'type' => $type,
        ];

        $pdf = PDF::loadView('admin-views.admin-receivables.receivables-pdf-report.summary', $data)->setPaper('legal', 'portrait');

        // download PDF file
        return $pdf->download($pdfName);
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

