<?php

namespace App\Http\Controllers;

use App\Models\CoBorrower;
use App\Models\Loan;
use App\Models\LoanApplicationState;
use App\Models\LoanApplicationStatus;
use App\Models\User;
use App\Models\Payment;
use App\Models\Witness;
use GuzzleHttp\Psr7\Query;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use function PHPUnit\Framework\isNull;

class LoanApplicationController extends Controller
{


    public function showLoanStatus($loan_id){
        $loan = Loan::with('loanType')->where('id',$loan_id)->first();
        if($loan==null){
            abort(404);
        }elseif ($loan->member_id != Auth::user()->member->id) {
            abort(404);
        }

        $loan_status=LoanApplicationStatus::with('LoanApplicationState')
        ->where('loan_id', $loan_id)
        ->whereNull('is_deleted') //get status that are not deleted
        ->orderBy('loan_application_state_id', 'desc')
        ->get();

        // if loan has no status abort
        // if(count($loan_status)==null){
        //     abort(404);
        // }


        return view('member-views.loan-applications.loan-application-status', compact('loan_status', 'loan'));
    }

    //SHOW MPL APPLICATION FORM
    public function show(){
        $user = Auth::user();
        $loans = Loan::where('member_id', $user->member->id)->where('is_active', 1)->get();
        //get members additional_loan column
        $additionalLoan = $user->member->additional_loan;

        //get all mpl loans
        $mplLoans = Loan::where('member_id', $user->member->id)->where('loan_type_id', 1)->where('is_active', 1)->get();

        //get all payments for mpl loans, grouped by loan_id
        $mplPayments = Payment::where('member_id', $user->member->id)
        ->whereIn('loan_id', $mplLoans->pluck('id'))
        ->get()
        ->groupBy('loan_id');

        //get total payments for mpl loans, by grouping the payments by loan_id and summing the interest and principal
        $totalPaymentsMPL = $mplPayments->map(function ($payments) {
            $totalInterest = $payments->sum('interest');
            $totalPrincipal = $payments->sum('principal');
            return $totalInterest + $totalPrincipal;
        });

        $inActiveLoan = CoBorrower::with(
            'member.units.campuses',
            'loan.member.units.campuses',
            'loan.loanApplicationStatus.loanApplicationState',
            'loan.loanType'
        )
        ->where('accept_request', '1') // Get loans accepted by coBorrower
        ->whereHas('loan', function ($query) {
            $query->where(function ($query) {
                $query->where('member_id', Auth::user()->member->id)
                    ->orWhereNull('member_id')
                    ->orWhere('member_id', 0);
            })
            ->where(function ($query) {
                $query->where('is_active', 0)
                    ->orWhereNull('is_active');
            });
        })->first();

        $mplTotalAmount = 0;

        // Get total amount of all loans
        foreach ($loans as $loan) {
            $mplTotalAmount += ($loan->principal_amount + $loan->interest);
        }

        $mplTotalBalance = $mplTotalAmount;

        // Get total balance of all loans
        foreach ($loans as $loan) {
            if(isset($totalPaymentMPL) && isset($totalPaymentMPL[$loan->id])){
            $mplTotalBalance -= $totalPaymentMPL[$loan->id];
            }
        }

        // Check if all MPL loans have been paid 50%
        $allMPLPaid50Percent = $mplLoans->isEmpty() || $mplLoans->every(function ($loan) use ($totalPaymentsMPL) {
            return isset($totalPaymentsMPL[$loan->id]) && $totalPaymentsMPL[$loan->id] >= 0.5 * ($loan->principal_amount + $loan->interest);
        });

        // MPL is disabled if there is an active loan or if all MPL loans have not been paid 50% and
        $mplDisabled = !empty($inActiveLoan) || !$allMPLPaid50Percent && ($additionalLoan == 0 || $additionalLoan == null || $additionalLoan == 2 && $additionalLoan != 3);

        // if mplDisabled is true, return abort 403
        if($mplDisabled){
            abort(403);
        }

        return view('member-views.mpl-application-form.mpl-application-form');
    }

    // SHOW HSL APPLICATION FORM
    public function showHsl(){
        $user = Auth::user();
        $loans = Loan::where('member_id', $user->member->id)->where('is_active', 1)->get();
        //get members additional_loan column
        $additionalLoan = $user->member->additional_loan;

        //get all hsl loans
        $hslLoans = Loan::where('member_id', $user->member->id)->where('loan_type_id', 2)->where('is_active', 1)->get();

        //get all payments for hsl loans, grouped by loan_id
        $hslPayments = Payment::where('member_id', $user->member->id)
        ->whereIn('loan_id', $hslLoans->pluck('id'))
        ->get()
        ->groupBy('loan_id');

        //get total payments for hsl loans, by grouping the payments by loan_id and summing the interest and principal
        $totalPaymentsHSL = $hslPayments->map(function ($payments) {
            $totalInterest = $payments->sum('interest');
            $totalPrincipal = $payments->sum('principal');
            return $totalInterest + $totalPrincipal;
        });

        $inActiveLoan = CoBorrower::with(
            'member.units.campuses',
            'loan.member.units.campuses',
            'loan.loanApplicationStatus.loanApplicationState',
            'loan.loanType'
        )
        ->where('accept_request', '1') // Get loans accepted by coBorrower
        ->whereHas('loan', function ($query) {
            $query->where(function ($query) {
                $query->where('member_id', Auth::user()->member->id)
                    ->orWhereNull('member_id')
                    ->orWhere('member_id', 0);
            })
            ->where(function ($query) {
                $query->where('is_active', 0)
                    ->orWhereNull('is_active');
            });
        })->first();

        $hslTotalAmount = 0;

        // Get total amount of all loans
        foreach ($loans as $loan) {
            $hslTotalAmount += ($loan->principal_amount + $loan->interest);
        }

        $hslTotalBalance = $hslTotalAmount;

        // Get total balance of all loans
        foreach ($loans as $loan) {
            if(isset($totalPaymentHSL) && isset($totalPaymentHSL[$loan->id])){
                $hslTotalBalance -= $totalPaymentHSL[$loan->id];
            }
        }

        // Check if all HSL loans have been paid 50%
        $allHSLPaid50Percent = $hslLoans->isEmpty() || $hslLoans->every(function ($loan) use ($totalPaymentsHSL) {
            return isset($totalPaymentsHSL[$loan->id]) && $totalPaymentsHSL[$loan->id] >= 0.5 * ($loan->principal_amount + $loan->interest);
        });

        // HSL is disabled if there is an active loan or if all HSL loans have not been paid 50% and additional loan is not 3 and 2
        $hslDisabled = !empty($inActiveLoan) || !$allHSLPaid50Percent && ($additionalLoan == 0 || $additionalLoan == null || $additionalLoan == 1 && $additionalLoan != 3);

        // if hslDisabled is true, return abort 403
        if($hslDisabled){
            abort(403);
        }

        return view('member-views.hsl-application-form.hsl-application-form');
    }



    // SHOW LIST OF LOAN APPLICATIONS
    public function showLoanApplications(){

        $raw_loans = CoBorrower::with(
            'member.units.campuses',
            'loan.member.units.campuses',
            'loan.loanApplicationStatus.loanApplicationState',
            'loan.loanType',
            //get loans with status
            )
            ->where('accept_request', '1') //get loans accepted by coBorrower
            ->whereHas('loan', function ($query){
                $query->where('member_id', Auth::user()->member->id)
                        ->whereNull('is_active');
            })->orderBy('id','desc')->get();

            // filter loans - get only applications that are not rejected
            $loans = [];
            foreach ($raw_loans as $raw_loan){
                $array = [];
                foreach($raw_loan->loan->loanApplicationStatus as $status){
                    array_push($array, $status->loan_application_state_id);
                }
                if(!in_array(6,$array)){
                    array_push($loans, $raw_loan);
                }
            }


        return view('member-views.loan-applications.loan-applications', compact('loans'));
    }
    // SHOW LOANS DENIED OR EVALUATED
    public function showLoanApplicationsEvaluated(){
        $raw_loans = CoBorrower::with(
            'member.units.campuses',
            'loan.member.units.campuses',
            'loan.loanApplicationStatus.loanApplicationState',
            'loan.loanType',
            //get loans with status
            )
            ->where('accept_request', '1') //get loans accepted by coBorrower
            ->whereHas('loan', function ($query){
                $query->where('member_id', Auth::user()->member->id);
                        // ->whereNotNull('is_active');
            })->orderBy('id','desc')->get();

            // filter loans - get only applications that are rejected or is_active not nutll
            // in other words get loans that are evaluated
            $loans = [];
            foreach ($raw_loans as $raw_loan){
                $array = [];
                foreach($raw_loan->loan->loanApplicationStatus as $status){
                    array_push($array, $status->loan_application_state_id);
                }
                if(in_array(6,$array) || $raw_loan->loan->is_active != null){
                    array_push($loans, $raw_loan);
                }
            }


        return view('member-views.loan-applications.loan-applications', compact('loans'));
    }


    public function showLoanApplicationsAll(){
        $loans = CoBorrower::with(
            'member.units.campuses',
            'loan.member.units.campuses',
            'loan.loanApplicationStatus.loanApplicationState',
            'loan.loanType',
            //get loans with status
            )
            ->where('accept_request', '1') //get loans accepted by coBorrower
            ->whereHas('loan', function ($query){
                $query->where('member_id', Auth::user()->member->id);
            })->orderBy('id','desc')->get();


        return view('member-views.loan-applications.loan-applications', compact('loans'));
    }








    // ============================VALIDATE AND STORE MPL APPLICATION==============================
    public function storeRequest(Request $request, $loanTypeId){
        // dd($request);
        if($loanTypeId > 2){
            abort(404);
        }
        $formFields = $request->validate([
            'email_co_borrower' => 'required|email|exists:users,email',
            'principal_amount'=> ['required', 'numeric', 'min:50000', 'max:200000'],
            'term_years'=> ['required', 'numeric', 'min:1', 'max:5'],
            'witness_name_1'=>'required',
            'witness_name_2'=>'required',
            // 'email_witness_1'=> 'required|email|exists:users,email',
            // 'email_witness_2'=> 'required|email|exists:users,email',
        ]);

        // check if the email inputs are the same with the User's logged in email
        // -- I COMMENTED THIS OUT FIRST FOR TESTING PURPOSES SO DEVELOPERS CAN TEST THE CO-BORROWER FUNCTIONALITY
        // -- WITH THE LOGGED IN EMAIL
        // if(
        //     $request->email_co_borrower == Auth::user()->email ||
        //     $request->email_witness_1 == Auth::user()->email ||
        //     $request->email_witness_2 == Auth::user()->email)
        // {
        //     return back()->with('email_error', 'You cannot enter your own email');
        // }
        // if($request->email_witness_1 == $request->email_witness_2 ||
        //     $request->email_witness_1 == $request->email_co_borrower ||
        //     $request->email_witness_2 == $request->email_co_borrower
        // ){
        //     return back()->with('email_error', 'Make sure all emails are unique');
        // }

        $co_borrower = User::where('email', $request->email_co_borrower)->with('member')->first();
        // $witness_1 = User::where('email', $request->email_witness_1)->with('member')->first();
        // $witness_2 = User::where('email', $request->email_witness_2)->with('member')->first();

        if(
            !$co_borrower->member->verified_at
            // || !$witness_1->member->verified_at
            // || !$witness_2->member->verified_at
        ){
            return back()->with('email_error', 'Make sure that all emails are from verified eBUPF members');
        }

        $loan = Loan::create([
            'member_id'=>Auth::user()->id,
            'loan_type_id'=>$loanTypeId,
            'principal_amount'=>$formFields['principal_amount'],
            'original_principal_amount'=>$formFields['principal_amount'],
            'term_years'=>$formFields['term_years'],
        ]);

        CoBorrower::create([
            'member_id'=>$co_borrower->member->id,
            'loan_id'=>$loan->id,
        ]);

        Witness::create([
            'witness_name'=>$formFields['witness_name_1'],
            'loan_id'=>$loan->id,
        ]);

        Witness::create([
            'witness_name'=>$formFields['witness_name_2'],
            'loan_id'=>$loan->id,
        ]);

        return view('member-views.mpl-application-form.confirmation');
    }


    public function cancelApplication($id){
        $co_borrower = CoBorrower::where('loan_id',$id)->with('loan')->first();

        if($co_borrower == null){
            abort(404);
        }else{
            if($co_borrower->accept_request == 1){
                return back()->with('fail' ,'Cannot be cancelled: Loan is already accepted');
            }
            else{
                $witnesses = Witness::where('loan_id' , $id)->with('loan')->get();
                $loan = Loan::find($id);

                foreach ($witnesses as $witness) {
                    $witness->delete();
                }
                $co_borrower->delete();
                $loan->delete();

                return back()->with('passed' ,'Loan Application Cancelled: Loan Application has been deleted.');
            }
        }


    }



} // THIS IS THE LAST TAG
