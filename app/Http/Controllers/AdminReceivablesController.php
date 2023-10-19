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
        // Define an array to store quarterly payments for each loan
        $quarterlyPayments = [];
        $quarterlyPaymentsForInterest = [];

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

    public function summary($report, $loan_type) {
        // Get all payments
        $payments = Payment::all();

        // Get all units and count their members
        $units = Unit::whereHas('members')->withCount('members')->get();

        // Initialize an array to store unit payments
        $unitPayments = [];

        if ($loan_type == 'mpl') {
            // Retrieve all members who have MPL loans with at least one payment
            $membersWithMPLLoans = Member::whereHas('loans', function ($query) {
                $query->where('loan_type_id', 1); // Get MPL loans
            })->get();

            foreach ($units as $unit) {
                $unitId = $unit->id;
                $membersInUnit = $membersWithMPLLoans->where('unit_id', $unitId);
                $unitPrincipalPayments = 0;
                $unitInterestPayments = 0;

                foreach ($membersInUnit as $member) {
                    // Get all loans of this member with the specified loan type
                    $memberLoans = $member->loans->where('loan_type_id', 1);

                    // Initialize member-level payments
                    $memberPrincipalPayments = 0;
                    $memberInterestPayments = 0;

                    foreach ($memberLoans as $loan) {
                        $loanId = $loan->id;

                        $memberPayments = $payments->where('member_id', $member->id)->where('loan_id', $loanId);

                        if ($memberPayments->isNotEmpty()) {
                            // Calculate principal and interest payments for each loan
                            $principalPayments = $memberPayments->sum('principal');
                            $interestPayments = $memberPayments->sum('interest');
                        } else {
                            $principalPayments = 0;
                            $interestPayments = 0;
                        }

                        // Accumulate payments for all loans of this member
                        $memberPrincipalPayments += $principalPayments;
                        $memberInterestPayments += $interestPayments;
                    }

                    // Accumulate payments for all members in the unit
                    $unitPrincipalPayments += $memberPrincipalPayments;
                    $unitInterestPayments += $memberInterestPayments;
                }

                // Store the unit payments in the array
                $unitPayments[$unitId] = [
                    'principal_payments' => $unitPrincipalPayments,
                    'interest_payments' => $unitInterestPayments,
                ];
            }
        } elseif ($loan_type == 'hsl') {
            // Retrieve all members who have HSL loans with at least one payment
            $membersWithHSLLoans = Member::whereHas('loans', function ($query) {
                $query->where('loan_type_id', 2); // Get HSL loans
            })->get();

            foreach ($units as $unit) {
                $unitId = $unit->id;
                $membersInUnit = $membersWithHSLLoans->where('unit_id', $unitId);
                $unitPrincipalPayments = 0;
                $unitInterestPayments = 0;

                foreach ($membersInUnit as $member) {
                    // Get all loans of this member with the specified loan type
                    $memberLoans = $member->loans->where('loan_type_id', 2);

                    // Initialize member-level payments
                    $memberPrincipalPayments = 0;
                    $memberInterestPayments = 0;

                    foreach ($memberLoans as $loan) {
                        $loanId = $loan->id;

                        $memberPayments = $payments->where('member_id', $member->id)->where('loan_id', $loanId);

                        if ($memberPayments->isNotEmpty()) {
                            // Calculate principal and interest payments for each loan
                            $principalPayments = $memberPayments->sum('principal');
                            $interestPayments = $memberPayments->sum('interest');
                        } else {
                            $principalPayments = 0;
                            $interestPayments = 0;
                        }

                        // Accumulate payments for all loans of this member
                        $memberPrincipalPayments += $principalPayments;
                        $memberInterestPayments += $interestPayments;
                    }

                    // Accumulate payments for all members in the unit
                    $unitPrincipalPayments += $memberPrincipalPayments;
                    $unitInterestPayments += $memberInterestPayments;
                }

                // Store the unit payments in the array
                $unitPayments[$unitId] = [
                    'principal_payments' => $unitPrincipalPayments,
                    'interest_payments' => $unitInterestPayments,
                ];
            }
        } else {
            abort(404); // Invalid loan type
        }

        // Pass the data to the view and render it
        return view('admin-views.admin-receivables.admin-receivables-summary', compact(
            'report',
            'loan_type',
            'units',
            'unitPayments'
        ));
    }



    public function remit($report, $loan_type){
        return view('admin-views.admin-receivables.admin-receivables-remit',
        compact(
            'report',
            'loan_type',
        ));
    }

}
