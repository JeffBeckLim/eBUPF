<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\LoanLog;
use App\Models\Penalty;
use App\Mail\AddPenalty;
use Illuminate\Http\Request;
use App\Models\PenaltyPayment;
use GuzzleHttp\Promise\Create;
use App\Mail\AddPenaltyPayment;
use App\Models\PenaltyPaymentLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PenaltyController extends Controller
{
    public function updatePenalty(Request $request, $id){

        $loan = Loan::where('id',$id)->with('loanType', 'loanCategory')->first();

        $formFields = $request->validate([
            'penalty_total'=> 'required|numeric|min:1',
            'penalized_month'=> 'required|integer|min:1',
            'penalized_year'=> 'required|integer|min:1'
        ]);

        if($loan == null){
            abort(403);
        }
        $loanType = $loan->loanType->loan_type_name;
        $member = $loan->member;
        $totalPenalty = $formFields['penalty_total'];
        $penalizedMonth = $formFields['penalized_month'];
        $penalizedYear = $formFields['penalized_year'];

        //get the month of the penalty based on the penalized month int
        $penaltyMonth = date('F', mktime(0, 0, 0, $penalizedMonth, 10));

        Mail::to($loan->member->user->email)->send(new AddPenalty($member, $totalPenalty, $penaltyMonth, $penalizedYear, $loanType, $loan));
        
        
        $mandatory = Penalty::create([
            'loan_id'=>$loan->id,
            'penalty_total' => $formFields['penalty_total'],
            'penalized_month' => $formFields['penalized_month'],
            'penalized_year' => $formFields['penalized_year']
        ]);

        LoanLog::create([
            'loan_id_log'=>$loan->loan_id,
            'loan_code_log'=>$loan->loan_code,
            'loan_type_log'=>$loan->loanType->loan_type_name,
            'principal_amount_log'=>$loan->principal_amount,
            'interest_log'=>$loan->interest,
            'is_active_log'=>$loan->is_active,
            'term_years_log'=>$loan->term_years,
            'deleted_at_log'=>$loan->deleted_at,
            'create_update_or_delete'=>"Penalized, "."Php ".$mandatory->penalty_total.", M-".$mandatory->penalized_month.", Y- ".$mandatory->penalized_year,
            'updated_by'=>Auth::user()->member->id,
        ]);

        return back()->with('passed', 'Penalty successfully added! ');
    }

    public function createPenaltyPayment(Request $request){

        $formFields = $request->validate([
            'penalty_payment_amount'=> 'required|numeric|min:1',
            'penalty_id'=>'required',
            'or_number'=>'nullable',
            'payment_date'=>'nullable'
        ]);

        $penalty = Penalty::where('id', $formFields['penalty_id'])->first();

        $new_penalty_payments = PenaltyPayment::where('penalty_id' , $penalty->id)->sum('penalty_payment_amount');

        $penalty_balance = $penalty->penalty_total - $new_penalty_payments;

        if($formFields['penalty_payment_amount'] > $penalty_balance){
            return back()->with('warning', 'Cannot add payment greater than remaining balance');
        }

        $loan = Loan::where('id',$penalty->loan_id)->first();

        if($penalty == null && $loan == null){
            abort(403);
        }
        // check if penalty table exist
        if($penalty != null){
            $new_penalty_payment = PenaltyPayment::create([
                'member_id'=>$loan->member_id,
                'penalty_id'=>$penalty->id,
                'penalty_payment_amount'=> $formFields['penalty_payment_amount'],
                'payment_date'=> $formFields['payment_date'],
                'or_number'=>$formFields['or_number'],
            ]);

            $loanType = $loan->loanType->loan_type_name;
            $member = $loan->member;
            $totalPenaltyPayment = $formFields['penalty_payment_amount'];
            $orNumber = $formFields['or_number'];
            $paymentDate = $formFields['payment_date'];
            $penalizedMonth = $penalty->penalized_month;
            $penalizedYear = $penalty->penalized_year;

             //get the month of the penalty based on the penalized month int
            $penaltyMonth = date('F', mktime(0, 0, 0, $penalizedMonth, 10));

            Mail::to($loan->member->user->email)->send(new AddPenaltyPayment($member, $totalPenaltyPayment, $penaltyMonth, $penalizedYear, $loanType, $loan, $orNumber, $paymentDate));

            return back()->with('passed', 'Penalty Payment Added');

        }else{
            abort(404);
        }
    }

    public function updatePenaltyPayment(Request $request, $penaltyPayment_id){
        $penaltyPayment = PenaltyPayment::findOrFail($penaltyPayment_id);

        $formFields = $request->validate([
            'penalty_payment_amount'=> 'required|numeric|min:1',
            'payment_date'=>'required|date',
            'or_number'=>'nullable',
        ]);

        if($penaltyPayment != null){

            $penaltyPayment->penalty_payment_amount = $formFields['penalty_payment_amount'];
            $penaltyPayment->payment_date = $formFields['payment_date'];
            $penaltyPayment->or_number = $formFields['or_number'];
            $penaltyPayment->save();

            return back()->with('passed', 'Penalty Payment Updated');

        }else{
            abort(404);
        }
    }

    public function deletePenaltyPayment($penaltyPayment_id){
        $penaltyPayment = PenaltyPayment::findOrFail($penaltyPayment_id);

        if($penaltyPayment->payment_date == null){
            $paymentDateLog = $penaltyPayment->created_at;
        }
        else{
            $paymentDateLog = $penaltyPayment->payment_date;
        }

        if($penaltyPayment != null){

            $log_id =  PenaltyPaymentLog::create([
                'member_id' => $penaltyPayment->member_id,
                'penalty_id_log' => $penaltyPayment->penalty_id,
                'penalty_payment_amount_log' => $penaltyPayment->penalty_payment_amount,
                'payment_date_log' => $paymentDateLog,
                'or_number_log' => $penaltyPayment->or_number,
            ]);

            $query_log = PenaltyPaymentLog::findOrFail($log_id->id);

            if($query_log){

                // Delete the payment record from the original table
                $penaltyPayment->delete();

                return redirect()->back()->with('success', 'Penalty Payment Successfully Deleted');
            }else{
                return redirect()->back()->with('error', 'Payment not deleted.');
            }
        }else{
            abort(404);
        }
    }

    public function showPenaltyPaymentLogs(){
        $penaltyPaymentLogs = PenaltyPaymentLog::with('member', 'penalty')->get();
        //d($penaltyPaymentLogs->penalty);
        //dd($penaltyPaymentLogs);
        return view('admin-views.admin-logs.admin_loan_logs', compact('penaltyPaymentLogs'));
    }
}
