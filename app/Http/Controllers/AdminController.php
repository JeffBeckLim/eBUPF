<?php

namespace App\Http\Controllers;

use App\Models\MembershipApplication;
use App\Models\User;
use App\Models\Loan;
use App\Models\Member;
use App\Models\Payment;
use App\Models\Unit;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){

        $member_count = count(User::where('user_type','member')->get());

        $user_total = count(User::all());
    
        $admin_count = count(User::where('user_type','admin')->get());
        $restricted_count = count(User::where('user_type','restricted')->get());
        $non_member_count = count(User::where('user_type','non-member')->get());

        $membership_total = count(MembershipApplication::all());
        $membership_pending_count = count(MembershipApplication::where('status', 0)->get());
        $membership_approved_count = count(MembershipApplication::where('status', 1)->get());
        $membership_rejected_count = count(MembershipApplication::where('status', 2)->get());
    

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
