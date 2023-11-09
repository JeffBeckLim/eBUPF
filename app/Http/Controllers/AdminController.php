<?php

namespace App\Http\Controllers;

use App\Models\CoBorrower;
use App\Models\MembershipApplication;
use App\Models\User;
use App\Models\Loan;
use App\Models\LoanApplicationStatus;
use App\Models\Member;
use App\Models\Payment;
use App\Models\Unit;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function countLoanApp($mpl_loans, $state_id){
        
         if(count($mpl_loans) == 0){
            return 0;
            // if no loans exist
         }
         $count = 0;
        foreach($mpl_loans as $mpl){
            $loan_statuses = [];
            foreach($mpl->loanApplicationStatus as $mpl_status){
                array_push($loan_statuses,$mpl_status->loan_application_state_id);
            }
            
            // check if approved status is in array
            if(in_array(3,$loan_statuses)){
                if($mpl->is_active == $state_id){
                    $count += 1;
                }
            }
        }
        return ($count);
    }
    public function index(){

        $member_count = count(User::where('user_type','member')->get());

        $user_total = count(User::all());
    
        $admin_count = count(User::where('user_type','admin')->get());
        $restricted_count = count(User::where('user_type','restricted')->get());
        $non_member_count = count(User::where('user_type','non-member')->get());

       
        $membership_pending_count = count(MembershipApplication::where('status', 0)->get());
        $membership_approved_count = count(MembershipApplication::where('status', 1)->get());
        $membership_rejected_count = count(MembershipApplication::where('status', 2)->get());
        $membership_total = count(MembershipApplication::all());

        $performing_mpl_interest = Loan::where('is_active', 1)->where('loan_type_id', 1)->sum('interest');
        $performing_mpl_principal = Loan::where('is_active', 1)->where('loan_type_id', 1)->sum('principal_amount');

        $performing_hsl_interest = Loan::where('is_active', 1)->where('loan_type_id', 2)->sum('interest');
        $performing_hsl_principal = Loan::where('is_active', 1)->where('loan_type_id', 2)->sum('principal_amount');

    
        $performing_loans = Loan::where('is_active', 1)->with('payment')->get();
        
        $mpl_principal_pay = 0;
        $mpl_interest_pay = 0;
        $hsl_principal_pay = 0;
        $hsl_interest_pay = 0;

        foreach($performing_loans as $performing_loan){
            foreach($performing_loan->payment as $payment){
                if($performing_loan->loan_type_id == 1){
                    $mpl_principal_pay +=$payment->principal;
                    $mpl_interest_pay +=$payment->interest;
                }else{
                    $hsl_principal_pay +=$payment->principal;
                    $hsl_interest_pay +=$payment->interest;
                }   
            }
        }
        // Used in charts
        $mpl_loans = Loan::with('loanApplicationStatus')->where('loan_type_id', 1)->get();
        $hsl_loans = Loan::with('loanApplicationStatus')->where('loan_type_id', 2)->get();

        // charts 
        // pie 1

        $performing_mpl = $this->countLoanApp($mpl_loans, 1);
        $closed_mpl = $this->countLoanApp($mpl_loans, 2);
        $unevaluated_mpl = $this->countLoanApp($mpl_loans, 0);

        $pie_mpl = [$performing_mpl, $closed_mpl, $unevaluated_mpl];

        // pie 2
        $performing_hsl = $this->countLoanApp($hsl_loans, 1);
        $closed_hsl = $this->countLoanApp($hsl_loans, 2);
        $unevaluated_hsl = $this->countLoanApp($hsl_loans, 0);
        
        $pie_hsl = [$performing_hsl, $closed_hsl, $unevaluated_hsl];


        $loans = Loan::with('loanApplicationStatus')->get();

        // bar chart
        $no_status_mpl = 0;
        $staff_mpl = 0;
        $analyst_mpl=0;
        $approved_mpl=0;
        $check_mpl=0;
        $picked_mpl=0;
        $rejected_mpl=0;

        $no_status_hsl = 0;
        $staff_hsl = 0;
        $analyst_hsl=0;
        $approved_hsl=0;
        $check_hsl=0;
        $picked_hsl=0;
        $rejected_hsl=0;

        $count_application_mpl = 0;
        $count_application_hsl = 0;

        foreach($loans as $loan){
            $loan->loan_type_id == 1 ? $count_application_mpl+=1 : $count_application_hsl+=1;
            if(count($loan->loanApplicationStatus)==0){
                $loan->loan_type_id == 1 ? $no_status_mpl+=1 : $no_status_hsl+=1;
            }else{
            foreach($loan->loanApplicationStatus as $status){
                
               
                    if($status->loan_application_state_id == 1){
                        $loan->loan_type_id == 1 ? $staff_mpl+=1 : $staff_hsl+=1;
                    }
                    else if($status->loan_application_state_id == 2){
                        $loan->loan_type_id == 1 ? $analyst_mpl+=1 : $analyst_hsl+=1;
                    }
                    else if($status->loan_application_state_id == 3){
                        $loan->loan_type_id == 1 ? $approved_mpl=1 : $approved_hsl+=1;
                    }
                    else if($status->loan_application_state_id == 4){
                        $loan->loan_type_id == 1 ? $check_mpl=1 : $check_hsl+=1;
                    }
                    else if($status->loan_application_state_id == 5){
                        $loan->loan_type_id == 1 ? $picked_mpl=1 : $picked_hsl+=1;
                    }
                    else if($status->loan_application_state_id == 6){
                        $loan->loan_type_id == 1 ? $rejected_mpl=1 : $rejected_hsl+=1;
                    }
                
                }
            }
        }
        
        $bar_mpl = [$staff_mpl, $analyst_mpl, $approved_mpl, $check_mpl, $picked_mpl, $rejected_mpl,];
        $bar_hsl = [$staff_hsl, $analyst_hsl, $approved_hsl, $check_hsl, $picked_hsl, $rejected_hsl,];

        $latest_user = User::latest('id')->first();
        $latest_member_app = MembershipApplication::latest('id')->first();
        $latest_loan_app = CoBorrower::latest('id')->whereNotNull('accept_request')->first();
        // dd($latest_loan_app);


        return view('admin-views.admin-dashboard', compact(
            'member_count',
            'user_total',
            'admin_count',
            'restricted_count',
            'non_member_count',
            'membership_total',
            'membership_pending_count',
            'membership_approved_count',
            'membership_rejected_count',
            'performing_mpl_interest',
            'performing_mpl_principal',
            'performing_hsl_interest',
            'performing_hsl_principal',

            'mpl_principal_pay',
            'mpl_interest_pay',
            'hsl_principal_pay',
            'hsl_interest_pay',

            'pie_mpl',
            'pie_hsl',

            'bar_mpl',
            'bar_hsl',

            'no_status_mpl',
            'no_status_hsl',

            'count_application_mpl',
            'count_application_hsl',

            'latest_user',
            'latest_member_app',
            'latest_loan_app',
        ));

    }
   

    public function allUsers(){
        $users = User::with('member.membershipApplication')->get();
        return view('admin-views.admin-members.admin-all-accounts', compact('users'));
    }

    // show all Members Page
    public function showMembers(){
        $memberUsers = User::with('member.units.campuses')->where('user_type', 'member')->get();
        $units = Unit::all();
        return view('admin-views.admin-members.admin-members', compact('memberUsers','units'));
    }
    // show filtered Members Page
    public function  showMembersFilter(Request $request){
        if($request->query('unit_filter') == 0){
            return redirect()->route('admin.members'); 
        }
        else{
            $unit_selected = $request->query('unit_filter');
        }

        $memberRaw = User::with('member.units.campuses')->where('user_type', 'member')->get();

        $memberUsers = [];
        foreach($memberRaw as $raw){
            if($raw->member->units->id == $unit_selected){
                array_push($memberUsers, $raw);
            }
        }

        $units = Unit::all();
        return view('admin-views.admin-members.admin-members', compact('memberUsers','units','unit_selected'));

    }


    public function memberLedger(){

        return view('admin-views.admin-ledger');
    }

    public function showRemittance(){
        $payments = Payment::all();
        return view('admin-views.admin-remittance',['payments' => $payments]);
    }

    public function addPaymentRemittance(Request $request){
        $data = $request->validate([
            'or_number' => 'required',
            'payment_date' => 'required|date',
            'loan_id' => 'required',
            'principal' => 'required|numeric',
            'interest' => 'required|numeric',
        ]);

        $existingPayment = Payment::where('or_number', $data['or_number'])->first();
        if ($existingPayment) {
            return redirect()->back()->with('error', 'Duplicate OR Number. Please use a different one.');
        }

        $loan = Loan::find($data['loan_id']);
        if (!$loan) {
            return redirect()->back()->with('error', 'Loan not found.');
        }

        $memberId = $loan->member_id;
        $data['member_id'] = $memberId;
        Payment::create($data);

        return redirect()->route('admin.remittance')->with('success', 'Payment saved successfully.');
    }

    public function allowAdditional(Request $request, $id){

        $member = Member::findOrFail($id);

        $member->additional_loan = $request->additional_loan;
        $member->save();

        return back()->with('additional_primary', 'Member additional loan privileges updated');
    }


} //LAST TAG
