<?php

namespace App\Http\Controllers;

use App\Models\MembershipApplication;
use App\Models\User;
use App\Models\Loan;
use App\Models\Payment;
use App\Models\PaymentLog;
use App\Models\Adjustment;
use App\Models\Amortization;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Form;
use App\Mail\SuccessfulPayment;
use App\Mail\PaidLoan;
use Illuminate\Support\Facades\Mail;

class AdminRemittanceController extends Controller
{
    public function showRemittance(){

        $payments = Payment::all();
        $adjustments = Adjustment::all();
        $loans = Loan::where('is_active', 1)->whereHas('amortization')->get();

        //get all the years of the payments, from the oldest to the latest payment
        $years = [];
        foreach ($payments as $payment) {
            $year = Carbon::parse($payment->payment_date)->format('Y');
            if (!in_array($year, $years)) {
                array_push($years, $year);
            }
        }
        if (count($years) == 0) {
            array_push($years, Carbon::now()->format('Y'));
        }

        return view('admin-views.admin-loan-remittance.admin-remittance', [
            'payments' => $payments,
            'loans' => $loans,
            'adjustments' => $adjustments,
            'years' => $years,
        ]);
    }

    public function addPaymentRemittance(Request $request){

        $data = $request->validate([
            'or_number' => 'required',
            'payment_date' => 'required|date',
            'loan_id' => 'required',
            'principal' => 'nullable|numeric',
            'interest' => 'numeric',
        ]);

        // Get member details
        $member = Loan::find($data['loan_id'])->member;

         // Replace null 'principal' with 0
        $data['principal'] = $data['principal'] ?? 0;

        // Get the loan based on the loan_id
        $loan = Loan::find($data['loan_id']);
        if (!$loan) {
            // if Loan not found
            return redirect()->back()->with('error', 'Loan not found.');
        }

        // Check if the payment is within the range of the amort_end and amort_start in the amortization table
        $amortization = $loan->amortization;
        $paymentDate = Carbon::parse($data['payment_date']);
        $amortStartDate = Carbon::parse($amortization->amort_start);
        $amortEndDate = Carbon::parse($amortization->amort_end);

        if ($paymentDate->format('Y-m') < $amortStartDate->format('Y-m') || $paymentDate->format('Y-m') > $amortEndDate->format('Y-m')) {
            return redirect()->back()->with('error', 'Payment date is not within the range of the amortization.');
        }

        //Calculate the total loan payment made using the loan_id and the principal and interest
        $totalLoanPayment = Payment::where('loan_id', $data['loan_id'])->sum('principal') + Payment::where('loan_id', $data['loan_id'])->sum('interest');
        $loanBalance = ($loan->principal_amount + $loan->interest) - $totalLoanPayment;

        // get the total payment for principal
        $totalPrincipalPayment = Payment::where('loan_id', $data['loan_id'])->sum('principal');

        // get the total payment for interest
        $totalInterestPayment = Payment::where('loan_id', $data['loan_id'])->sum('interest');
        // Check if the payment exceeds with the loan balance
        //dd($loanBalance, $data['principal'], $data['interest'], $data['principal'] + $data['interest'], $loanBalance - ($data['principal'] + $data['interest']));

       /*  if(($loanBalance - ($data['principal'] + $data['interest'])) < 0){
            return redirect()->back()->with('error', 'Payment exceeds loan balance.');
        }else */if($loan->principal_amount - ($totalPrincipalPayment + $data['principal']) < 0){
            return redirect()->back()->with('error', 'Principal payment exceeds principal balance.');
        }elseif($loan->interest - ($totalInterestPayment + $data['interest']) < 0){
            return redirect()->back()->with('error', 'Interest payment exceeds interest balance.');
        }

        $principal_amount = $data['principal'];
        $interest = $data['interest'];
        $loan = Loan::find($data['loan_id']);
        $date = Carbon::parse($data['payment_date'])->format('F d, Y');
        $OR_number = $data['or_number'];
        $loan_type = $loan->loanType->loan_type_name;

        // If the payment is equal to the loan balance, set the loan to non-performing
        if($loanBalance - ($data['principal'] + $data['interest']) <= 0){
            Mail::to($member->user->email)->send(new PaidLoan($member, $loan_type, $loan, $date));
            $loan->is_active = 2;
            $loan->save();
        }

        $memberId = $loan->member_id;
        $data['member_id'] = $memberId;

        // Send email to the member and save the payment to the database
        Mail::to($member->user->email)->send(new SuccessfulPayment($member, $principal_amount, $interest, $loan, $date, $OR_number));
        Payment::create($data);

        return redirect()->route('admin.remittance')->with('success', 'Payment saved successfully.');
    }

    public function updatePaymentRemittance(Request $request, $id) {

        // Validate the request data
        $validatedData = $request->validate([
            'or_number' => 'required',
            'payment_date' => 'required|date',
            'loan_id' => 'required',
            'principal' => 'nullable|numeric',
            'interest' => 'numeric',
        ]);

        // if principal is null, set to 0
        if (is_null($validatedData['principal'])) {
            $validatedData['principal'] = 0;
        }

        // Update the payment in the database
        Payment::where('id', $id)->update([
            'or_number' => $validatedData['or_number'],
            'payment_date' => $validatedData['payment_date'],
            'loan_id' => $validatedData['loan_id'],
            'principal' => $validatedData['principal'],
            'interest' => $validatedData['interest'],
        ]);

        return redirect()->back()->with('success', 'Payment updated successfully');
    }

    public function showLogsRemittance(){
        $paymentLogs = PaymentLog::with('member')->get();

        return view('admin-views.admin-loan-remittance.admin-remittance-log', [
            'paymentLogs' => $paymentLogs,
        ]);
    }

    public function deletePaymentRemittance($id) {
        // Retrieve the payment record
        $payment = Payment::find($id);

        if ($payment) {
            //record the payment to the PaymentLog table
            $log_id =  PaymentLog::create([
                'primary_key_log' => $payment->id,
                'or_number_log' => $payment->or_number,
                'payment_date_log' => $payment->payment_date,
                'loan_id_log' => $payment->loan_id,
                'principal_log' => $payment->principal,
                'interest_log' => $payment->interest,
                'member_id_log' => $payment->member_id,
            ]);

            $query_log = PaymentLog::findOrFail($log_id->id);

            if($query_log){
                // Delete the payment record from the original table
                $payment->delete();

                // Make the loan active if the loan balance is greater than 0
                $loan = Loan::find($payment->loan_id);
                $totalLoanPayment = Payment::where('loan_id', $payment->loan_id)->sum('principal') + Payment::where('loan_id', $payment->loan_id)->sum('interest');
                $loanBalance = ($loan->principal_amount + $loan->interest) - $totalLoanPayment;

                if($loanBalance > 0){
                    $loan->is_active = 1;
                    $loan->save();
                }

                // Redirect back with a success message
                return redirect()->back()->with('success', 'Payment deleted successfully. The record is saved in the logs.');
            }else{
                return redirect()->back()->with('error', 'Payment not deleted.');
            }

        } else {
            // Payment not found, return an error message
            return redirect()->back()->with('error', 'Payment not found');
        }
    }

}

