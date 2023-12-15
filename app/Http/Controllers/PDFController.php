<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Member;
use Carbon\Carbon;
use App\Models\Unit;
use App\Models\Loan;
use App\Models\Campus;
use App\Models\CoBorrower;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use App\Models\PenaltyPayment;
use App\Models\Payment;

class PDFController extends Controller{

    public function generateMembershipForm($id)
    {

        $member = Member::find($id);
        if ($member) {
            $dateOfBirth = Carbon::parse($member->date_of_birth);
            $currentDate = Carbon::now();
            $age = $currentDate->diffInYears($dateOfBirth);
            $member_unit = Unit::with('campuses')->findOrFail($member->unit_id);
            $memberbene = Member::with('beneficiaries')->findOrFail($id);
            $beneficiaries = $memberbene->beneficiaries;

            // Get the profile picture of the member and encode it to base64
            if ($member->profile_picture) {
                $profilePicturePath = 'storage/' . $member->profile_picture;
                $orientedImage = Image::make($profilePicturePath)->orientate();
            } else {
                $defaultImagePath = public_path('assets/no_profile_picture.jpg');
                $orientedImage = Image::make($defaultImagePath);
            }
            $encodedImage = $orientedImage->encode('data-url')->encoded;

            //get the first letter of the middle name in the members middlename column
            $middlename = $member->middlename;
            $middle_initial = substr($middlename, 0, 1);
            $initial = strtoupper($middle_initial);

            $data = [
                'currentdate' => date('Y-m-d'),
                'firstname' => $member->firstname,
                'lastname' => $member->lastname,
                'middle_initial' => $initial,
                'contact_num' => $member->contact_num,
                'address' => $member->address,
                'date_of_birth' => $member->date_of_birth,
                'tin_num' => $member->tin_num,
                'age' => $age,
                'position' => $member->position,
                'employee_num' => $member->employee_num,
                'bu_appointment_date' => $member->bu_appointment_date,
                'place_of_birth' => $member->place_of_birth,
                'civil_status' => $member->civil_status,
                'spouse' => $member->spouse,
                'sex' => $member->sex,
                'monthly_salary' => $member->monthly_salary,
                'monthly_contribution' => $member->monthly_contribution,
                'appointment_status' => $member->appointment_status,
                'profile_picture' => $encodedImage,
                'unit' => $member_unit->unit_code,
                'campus' => $member_unit->campuses->campus_code,
                'beneficiaries' => $beneficiaries,
            ];

            $pdf = PDF::loadView('member-views.generate-pdf-files.generate-membership-form', $data)->setPaper('letter', 'portrait');

            $fileName = "{$member->lastname} Membership Application Form.pdf";
            return $pdf->download($fileName);

        } else {
            return redirect()->back()->with('error', 'Member not found.');
        }

    }

    public function generateMPL($loanId)
    {
        $id = Auth::user()->member->id;
        $member = Member::find($id);
        $unit = Unit::where('id', $member->unit_id)->first();
        $campus = Campus::where('id', $unit->campus_id)->first();

        //calculate age
        $dateOfBirth = Carbon::parse($member->date_of_birth);
        $currentDate = Carbon::now();
        $age = $currentDate->diffInYears($dateOfBirth);

        //Loan table
        $loan = Loan::find($loanId);
        //Co Borrower details

        // fetch Co-Borrower Data
        $coBorrower = CoBorrower::where('loan_id', $loanId)->first();
        $coBorrowerId = $coBorrower->member_id;
        $co_borrower_details = Member::find($coBorrowerId);

        //co-borrower age
        $co_borrower_dateOfBirth = Carbon::parse($co_borrower_details->date_of_birth);
        $co_borrower_currentDate = Carbon::now();
        $co_borrower_age = $co_borrower_currentDate->diffInYears($co_borrower_dateOfBirth);

        //co-borrower unit
        $co_borrower_unit = Unit::where('id', $co_borrower_details->unit_id)->first();
        //co-borrower campus
        $co_borrower_campus = Campus::where('id', $co_borrower_unit->campus_id)->first();

         // get the witness
         $witnesses = $loan->witness;

         // get the witness names
         $witnessNames = [];
         foreach ($witnesses as $witness) {
             $witnessNames[] = $witness->witness_name;
         }

        //get the first letter of the middle name in the members middlename column
        $middlename = $member->middlename;
        $middle_initial = substr($middlename, 0, 1);
        $initial = strtoupper($middle_initial);
/*
        $interestRate = 0.06;
        $amount = intval($loan->original_principal_amount);
        $termYears = $loan->term_years;

         // Calculate yearly principal balance
         $yearlyPrincipalBalance = $amount / $termYears;
         $yearlyBalance = $amount;
         $totalInterest = 0;

         // Initialize an array to store the yearly balances
         $yearlyBalances = [];

        for ($year = 0; $year < $termYears; $year++) {
            $yearlyInterest = $yearlyBalance * $interestRate;
            $totalInterest += $yearlyInterest;

            $yearlyBalances[$year] = [
                'yearlyBalance' => $yearlyBalance,
                'yearlyInterest' => $yearlyInterest,
            ];
            $yearlyBalance -= $yearlyPrincipalBalance;
        }

        //dd($yearlyBalances);

        $totalInterestAndPrincipal = $amount + $totalInterest;

        //monthly amortization
        $monthlyAmort = $totalInterestAndPrincipal / ($termYears * 12);

        //monthly principal amortization without interest
        $monthlyPrincipalAmort = $amount / ($termYears * 12);

        //monthly principal Interest amortization
        $monthlyInterestAmort = $totalInterest / $termYears / 12;

        //total months
        $totalMonths = $termYears * 12;

        dd($yearlyBalances[0]); */

        $data = [
            'currentdate' => date('Y-m-d'),
            'lastname' => $member->lastname,
            'firstname' => $member->firstname,
            'middle_initial' => $initial,
            'date_of_birth' => $member->date_of_birth,
            'age' => $age,
            'tin' => $member->tin_num,
            'address' => $member->address,
            'unit' => $unit->unit_code,
            'contact_number' => $member->contact_num,
            'office' =>     $campus->campus_code,
            'monthly_net_pay' => $member->monthly_salary,
            'amount_requested' => $loan->principal_amount,

            'co_lastname' => $co_borrower_details->lastname,
            'co_firstname' => $co_borrower_details->firstname,
            'co_middle_initial' => $co_borrower_details->middle_initial,
            'co_date_of_birth' => $co_borrower_details->date_of_birth,
            'co_age' => $co_borrower_age,
            'co_tin' => $co_borrower_details->tin_num,
            'co_address' => $co_borrower_details->address,
            'co_unit' => $co_borrower_unit->unit_code,
            'co_contact_number' => $co_borrower_details->contact_num,
            'co_office' => $co_borrower_campus->campus_code,
            'co_monthly_net_pay' => $co_borrower_details->monthly_salary,
            'co_amount_requested' => $loan->principal_amount,

            'witnesses' => $witnessNames,

        ];

        $pdf = PDF::loadView('member-views.generate-pdf-files.generate-mpl-app-form', $data)->setPaper('legal', 'portrait');
        $fileName = "{$member->lastname} MPL Application Form.pdf";
        return $pdf->download($fileName);
    }

    public function generateHL($loanId){
        $id = Auth::user()->member->id;
        $member = Member::find($id);
        $unit = Unit::where('id', $member->unit_id)->first();
        $campus = Campus::where('id', $unit->campus_id)->first();

        //calculate age
        $dateOfBirth = Carbon::parse($member->date_of_birth);
        $currentDate = Carbon::now();
        $age = $currentDate->diffInYears($dateOfBirth);

        //Loan table
        $loan = Loan::find($loanId);
        //Co Borrower details

        // fetch Co-Borrower Data
        $coBorrower = CoBorrower::where('loan_id', $loanId)->first();
        $coBorrowerId = $coBorrower->member_id;
        $co_borrower_details = Member::find($coBorrowerId);


        //co-borrower age
        $co_borrower_dateOfBirth = Carbon::parse($co_borrower_details->date_of_birth);
        $co_borrower_currentDate = Carbon::now();
        $co_borrower_age = $co_borrower_currentDate->diffInYears($co_borrower_dateOfBirth);

        //co-borrower unit
        $co_borrower_unit = Unit::where('id', $co_borrower_details->first()->unit_id)->first();
        //co-borrower campus
        $co_borrower_campus = Campus::where('id', $co_borrower_unit->campus_id)->first();

        // get the witness
        $witnesses = $loan->witness;

        // get the witness names
        $witnessNames = [];
        foreach ($witnesses as $witness) {
            $witnessNames[] = $witness->witness_name;
        }

        //get the first letter of the middle name in the members middlename column
        $middlename = $member->middlename;
        $middle_initial = substr($middlename, 0, 1);
        $initial = strtoupper($middle_initial);

        $data = [
            'currentdate' => date('Y-m-d'),
            'lastname' => $member->lastname,
            'firstname' => $member->firstname,
            'middle_initial' => $initial,
            'date_of_birth' => $member->date_of_birth,
            'age' => $age,
            'tin' => $member->tin_num,
            'address' => $member->address,
            'unit' => $unit->unit_code,
            'contact_number' => $member->contact_num,
            'office' => $campus->campus_code,
            'monthly_net_pay' => $member->monthly_salary,
            'amount_requested' => $loan->principal_amount,
            'payment_period' => $loan->term_years,

            'co_lastname' => $co_borrower_details->lastname,
            'co_firstname' => $co_borrower_details->firstname,
            'co_middle_initial' => $co_borrower_details->middle_initial,
            'co_date_of_birth' => $co_borrower_details->date_of_birth,
            'co_age' => $co_borrower_age,
            'co_tin' => $co_borrower_details->tin_num,
            'co_address' => $co_borrower_details->address,
            'co_unit' =>  $co_borrower_unit->unit_code,
            'co_contact_number' => $co_borrower_details->contact_num,
            'co_office' => $co_borrower_campus->campus_code,
            'co_monthly_net_pay' => $co_borrower_details->monthly_salary,
            'co_amount_requested' => $loan->principal_amount,
            'co_payment_period' => $loan->term_years,

            'witnesses' => $witnessNames,

        ];

        $pdf = PDF::loadView('member-views.generate-pdf-files.generate-hsl-app-form', $data)->setPaper('legal', 'portrait');

        $fileName = "{$member->lastname} HL Application Form.pdf";
        return $pdf->download($fileName);
    }

    public function generateInsuranceForm(){
        $member = Auth::user()->member;

        // Calculate age
        $dateOfBirth = Carbon::parse($member->date_of_birth);
        $currentDate = Carbon::now();
        $age = $currentDate->diffInYears($dateOfBirth);
        $unit = Unit::where('id', $member->unit_id)->first();

        $dateOfBirth = Carbon::parse($member->date_of_birth)->format('m/d/Y');

        $data = [
            'currentdate' => date('Y-m-d'),
            'firstname' => $member->firstname,
            'lastname' => $member->lastname,
            'middlename' => $member->middlename,
            'sex' => $member->sex,
            'civilStatus' => $member->civil_status,
            'birthPlace' => $member->place_of_birth,
            'dateOfBirth' => $dateOfBirth,
            'age' => $age,
            'tin' => $member->tin_num,
            'address' => $member->address,
            'position' => $member->position,
            'unit' => $unit->unit_code,
            'employer' => 'BICOL UNIVERSITY',
            'contactNumber' => $member->contact_num,
            'email' => Auth::user()->email,
            'placeOfSigning' => 'BICOL UNIVERSITY, LEGAZPI CITY',
        ];

        $pdf = PDF::loadView('member-views.generate-pdf-files.generate-insurance-form', $data)->setPaper('legal', 'portrait');

        $fileName = "{$member->lastname} Insurance Form.pdf";
        return $pdf->download($fileName);
    }

    public function generateLedger($id){

        if(Payment::where('loan_id', $id)->count() == 0){
            return abort(401, 'Oops! This loan has no payments yet.');
        }

        $loan = Loan::find($id);

        //for filename - lastname, firstname - loan type - loan id
        $member = Member::find($loan->member_id);
        $loanType = $loan->loanType->loan_type_name;
        $loanId = $loan->id;
        $filename = "{$member->lastname}, {$member->firstname} - {$loanType} - {$loanId} Ledger.pdf";

        // add error catcher here to make sure that loang being retrieved is valid
        $loan = Loan::with('loanType' , 'amortization' , 'loanApplicationStatus' , 'payment', 'member.units' , 'loanCategory', 'penalty')->where('id' , $id)->first();

        $penalty_payments = PenaltyPayment::where('penalty_id' , $loan->penalty_id)
        ->orderBy('created_at', 'desc')
        ->get();

        $sumPenaltyPayments = $penalty_payments->sum('penalty_payment_amount');

        // if loan has missing amortization
        if($loan->amortization == null){
            return abort(401, 'Oops! This loan has some field missing.');
        }

        if($loan->amortization != null){
            if($loan->amortization->amort_start == null || $loan->amortization->amort_end == null ){
                return abort(403, 'Oops! This loan has some field missing in amortization period.');
            }
        }
        // get principal and interest PAID
        $principal_paid = 0;
        $interest_paid = 0;
        $payment_ids = [];

        // get total payments
        foreach($loan->payment as $payment){
            $principal_paid += $payment->principal;
            $interest_paid += $payment->interest;

            array_push($payment_ids, $payment->id);
        }

        // Get all payments
        $paymentsMade = Payment::where('loan_id', $loan->id)->get();

        // Get unique year and month combinations to get the total number of payments
        $uniquePayments = [];

        foreach ($paymentsMade as $payment) {
            $paymentDate = Carbon::parse($payment->payment_date);
            $yearMonth = $paymentDate->format('Y-m'); // Get year and month format

            // Check if the year and month combination already exists
            if (!isset($uniquePayments[$yearMonth])) {
                $uniquePayments[$yearMonth] = true; // Add if it doesn't exist
            }
        }

        $totalUniquePayments = count($uniquePayments);

        //Filter the payments by year and month
        $filteredPayments = [];
        foreach($paymentsMade as $payment){
            $paymentDate = Carbon::parse($payment->payment_date);
            $filteredPayments[$paymentDate->format('Y')][$paymentDate->format('F')][] = $payment;
        }


        if(count($payment_ids) != null){
            $latest_payment = Payment::find(max($payment_ids));
        }else{
            $latest_payment = null;
        }

        $amort_start_parsed = Carbon::parse($loan->amortization->amort_start);
        for ($x = $loan->term_years; $x != 0; $x--){

            $targetMonth = 1;
            $targetYear = $amort_start_parsed->copy()->addMonths($x * 12)->format('Y');


            $filteredPaymentModes = Payment::whereYear('payment_date', $targetYear)
            ->whereMonth('payment_date', $targetMonth)
            ->get();
        }

        $raw_loans = Loan::where('member_id' , $loan->member_id)->where('loan_type_id' , $loan->loan_type_id)->with('loanCategory' , 'loanType' , 'loanApplicationStatus' , 'amortization')->whereHas('amortization')
        ->orderBy('created_at', 'desc')
        ->get();

        // get the loans of the member for the dropdown
        $memberLoans = [];
        foreach($raw_loans as $raw_loan){
            $status_array = [];
            foreach($raw_loan->loanApplicationStatus as $status){
                    array_push($status_array, $status->loan_application_state_id);
                }
                if(in_array(5, $status_array)){
                    array_push($memberLoans, $raw_loan);
                }
            }

            $months = [
                'January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'
            ];

            $data = [
                'loan' => $loan,
                'member' => $member,
                'principal_paid' => $principal_paid,
                'interest_paid' => $interest_paid,
                'filteredPayments' => $filteredPayments,
                'latest_payment' => $latest_payment,
                'months' => $months,
                'memberLoans' => $memberLoans,
                'penalty_payments' => $penalty_payments,
                'sumPenaltyPayments' => $sumPenaltyPayments,
                'totalUniquePayments' => $totalUniquePayments,
            ];

        $pdf = PDF::loadView('member-views.generate-pdf-files.generate-ledger', $data)->setPaper('legal', 'landscape');
        return $pdf->download($filename);

    }

}
