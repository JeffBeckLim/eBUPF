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

        $pdfName = $year . ' Summary Report.pdf';
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

    public function generateReceivablesQuarterly(Request $request, $loan_type) {

        // Set the default selected year and unit
        $selectedYear = $request->input('yearSelect');
        $selectedUnit = $request->input('unitSelect');

        // Get the unit name from the unit code
        $unitCode = Unit::where('unit_code', $selectedUnit)->first()->unit_code;
        $unitName = Unit::where('unit_code', $selectedUnit)->first()->unit_address;

        $type = '';
        if($loan_type == 'mpl'){
            $loans = Loan::whereHas('amortization')->where('loan_type_id', 1)->get();
            $type = 'MPL';
        }elseif($loan_type == 'hsl'){
            $loans = Loan::whereHas('amortization')->where('loan_type_id', 2)->get();
            $type = 'HSL';
        }else{
            abort(404);
        }

        $pdfName = $type . ' ' .  $selectedYear . ' ' . $unitCode . ' Quarterly Report.pdf';

        // Get only the loans that match the selected year and unit
        $filteredLoans = $loans->filter(function ($loan) use ($selectedYear, $selectedUnit) {
            $amortStartYear = Carbon::parse($loan->amortization->amort_start)->year;
            $amortEndYear = Carbon::parse($loan->amortization->amort_end)->year;
            $unitCode = $loan->member->units->unit_code;

            return $selectedYear >= $amortStartYear && $selectedYear <= $amortEndYear && $selectedUnit == $unitCode;
        });

        // Define an array to store quarterly payments for each loan
        $quarterlyPayments = [];
        $quarterlyPaymentsForInterest = [];

        // Calculate quarterly payments for each loan
        foreach ($filteredLoans as $loan) {
            $loanId = $loan->id;
            $quarterlyPayments[$loanId] = $this->calculateQuarterlyPayments($loanId);
            $quarterlyPaymentsForInterest[$loanId] = $this->calculateQuarterlyInterestPayments($loanId);
        }


        $yearlyBalances = [];

        foreach ($filteredLoans as $loan) {

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
        $yearBalance = [];

        foreach ($yearlyBalances as $loanId => $yearlyBalance) {
            $yearBalance[$loanId] = $yearlyBalance[$selectedYear];
        }
        // Filter quarterly payments for the selected year each loan
        foreach ($quarterlyPayments as $loanId => $quarterlyPayment) {
            if (isset($quarterlyPayment[$selectedYear])) {
                $quarterlyPayments[$loanId] = [$selectedYear => $quarterlyPayment[$selectedYear]];
            } else {
                $quarterlyPayments[$loanId] = [$selectedYear => 0];
            }
        }

        // Filter quarterly payments for interest for the selected year each loan
        foreach ($quarterlyPaymentsForInterest as $loanId => $quarterlyPaymentForInterest) {
            $quarterlyPaymentsForInterest[$loanId] = [$selectedYear => $quarterlyPaymentForInterest[$selectedYear] ?? 0];
        }

        $lastDayThisYear = Carbon::parse($selectedYear . '-12-31')->format('m/d/Y');
        $lastDayPreviousYear = Carbon::parse(($selectedYear - 1) . '-12-31')->format('m/d/Y');

        // Get the total beginning and ending balances for the selected year
        $totalBeginningBalancePrincipal = 0;
        $totalEndingBalancePrincipal = 0;
        $totalBeginningBalanceInterest = 0;
        $totalEndingBalanceInterest = 0;
        foreach ($yearBalance as $loanId => $yearBalancePerLoan) {
            $totalBeginningBalancePrincipal += $yearBalancePerLoan['beginning_balance_principal'];
            $totalEndingBalancePrincipal += $yearBalancePerLoan['ending_balance_principal'];
            $totalBeginningBalanceInterest += $yearBalancePerLoan['beginning_balance_interest'];
            $totalEndingBalanceInterest += $yearBalancePerLoan['ending_balance_interest'];
        }

        // Get the total principal and interest payments for the selected year per quarter
        $totalPrincipalPayments = [];
        $totalInterestPayments = [];
        foreach ($quarterlyPayments as $loanId => $quarterlyPayment) {
            foreach ($quarterlyPayment as $year => $quarterlyPaymentPerYear) {
                if (!isset($totalPrincipalPayments[$year])) {
                    $totalPrincipalPayments[$year] = [
                        1 => 0,
                        2 => 0,
                        3 => 0,
                        4 => 0,
                    ];
                }

                foreach ($quarterlyPaymentPerYear as $quarter => $principalPayment) {
                    $totalPrincipalPayments[$year][$quarter] += $principalPayment;
                }
            }
        }
        foreach ($quarterlyPaymentsForInterest as $loanId => $quarterlyPaymentForInterest) {
            foreach ($quarterlyPaymentForInterest as $year => $quarterlyPaymentForInterestPerYear) {
                if (!isset($totalInterestPayments[$year])) {
                    $totalInterestPayments[$year] = [
                        1 => 0,
                        2 => 0,
                        3 => 0,
                        4 => 0,
                    ];
                }

                foreach ($quarterlyPaymentForInterestPerYear as $quarter => $interestPayment) {
                    $totalInterestPayments[$year][$quarter] += $interestPayment;
                }
            }
        }
        $data = [
            'unitName' => $unitName,
            'year' => $selectedYear,
            'loans' => $filteredLoans,
            'yearBalance' => $yearBalance,
            'quarterlyPayments' => $quarterlyPayments,
            'quarterlyPaymentsForInterest' => $quarterlyPaymentsForInterest,
            'selectedYear' => $selectedYear,
            'lastDayThisYear' => $lastDayThisYear,
            'lastDayPreviousYear' => $lastDayPreviousYear,
            'totalBeginningBalancePrincipal' => $totalBeginningBalancePrincipal,
            'totalEndingBalancePrincipal' => $totalEndingBalancePrincipal,
            'totalBeginningBalanceInterest' => $totalBeginningBalanceInterest,
            'totalEndingBalanceInterest' => $totalEndingBalanceInterest,
            'totalPrincipalPayments' => $totalPrincipalPayments,
            'totalInterestPayments' => $totalInterestPayments,
        ];


        $pdf = PDF::loadView('admin-views.admin-receivables.receivables-pdf-report.quarterly', $data)->setPaper('legal', 'landscape');

        // download PDF file
        return $pdf->download($pdfName);
    }

}

