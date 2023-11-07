<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\Unit;
use App\Models\User;
use App\Models\Campus;
use App\Models\Member;
use App\Models\Payment;
use App\Models\Witness;
use App\Models\CoBorrower;
use App\Rules\EmailDomain;
use App\Models\Beneficiary;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\LoanApplicationState;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\LoanApplicationStatus;
use App\Models\MembershipApplication;
use App\Models\BeneficiaryRelationship;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function showMemberDash(){
        $user = Auth::user();
        $loans = Loan::where('member_id', $user->member->id)->where('is_active', 1)->get();
        //get members additional_loan column
        $additionalLoan = $user->member->additional_loan;

        //get all mpl and hsl loans
        $mplLoans = Loan::where('member_id', $user->member->id)->where('loan_type_id', 1)->where('is_active', 1)->get();
        $hslLoans = Loan::where('member_id', $user->member->id)->where('loan_type_id', 2)->where('is_active', 1)->get();

        //get all payments for mpl and hsl loans, grouped by loan_id
        $mplPayments = Payment::where('member_id', $user->member->id)
        ->whereIn('loan_id', $mplLoans->pluck('id'))
        ->get()
        ->groupBy('loan_id');

        $hslPayments = Payment::where('member_id', $user->member->id)
        ->whereIn('loan_id', $hslLoans->pluck('id'))
        ->get()
        ->groupBy('loan_id');

        //get total payments for mpl and hsl loans, by grouping the payments by loan_id and summing the interest and principal
        $totalPaymentsMPL = $mplPayments->map(function ($payments) {
            $totalInterest = $payments->sum('interest');
            $totalPrincipal = $payments->sum('principal');
            return $totalInterest + $totalPrincipal;
        });

        $totalPaymentsHSL = $hslPayments->map(function ($payments) {
            $totalInterest = $payments->sum('interest');
            $totalPrincipal = $payments->sum('principal');
            return $totalInterest + $totalPrincipal;
        });

        //get remaining months[term] for each loan
        $loans->each(function ($loan) {
            $termYears = $loan->term_years;
            $totalMonths = $termYears * 12;

            // Retrieve all payments for the loan and order them by the "payment_date" column
            $payments = Payment::where('loan_id', $loan->id)
                ->orderBy('payment_date', 'asc')
                ->get();

            $countedMonths = 0;
            $previousMonthYear = null;

            foreach ($payments as $payment) {
                // Convert the string to a date object
                $paymentDate = date_create($payment->payment_date);

                // check if the month and year of the payment is different from the previous month and year of the payment
                $monthYear = date_format($paymentDate, 'Y-m');

                if ($monthYear !== $previousMonthYear) {
                    $countedMonths++;
                    $previousMonthYear = $monthYear;
                }
            }

            // Calculate remaining months by subtracting counted months from total months
            $remainingMonths = max(0, $totalMonths - $countedMonths);

            // Assign the calculated value to the loan
            $loan->remainingMonths = $remainingMonths;
        });

        $inActiveLoan = CoBorrower::with(
            'member.units.campuses',
            'loan.member.units.campuses',
            'loan.loanApplicationStatus.loanApplicationState',
            'loan.loanType'
        )
        ->whereHas('loan', function ($query) {
            $query->where(function ($query) {
                $query->where('member_id', Auth::user()->member->id)
                      ->orWhereNull('member_id')
                      ->orWhere('member_id', 0);
            })
            ->where(function ($query) {
                $query->where('is_active', 0)
                      ->orWhereNull('is_active')
                      ->orWhere('is_active', 0);
            });
        })->first();

        //get transactions -> Loan application and payment
        $transactionPayments = Payment::where('member_id', $user->member->id)->get();
        $transactionLoans = Loan::where('member_id', $user->member->id)->get();
        //combine transactions
        $unsortedTransactions = $transactionLoans->concat($transactionPayments);
        //sort transactions by date
        $transactions = $unsortedTransactions->sortByDesc('created_at');

        $mplTotalAmount = 0;
        $hslTotalAmount = 0;

        // Get total amount of all loans
        foreach ($loans as $loan) {
            if ($loan->loan_type_id == 1) {
                $mplTotalAmount += ($loan->principal_amount + $loan->interest);
            } elseif ($loan->loan_type_id == 2) {
                $hslTotalAmount += ($loan->principal_amount + $loan->interest);
            }
        }

        $mplTotalBalance = $mplTotalAmount;
        $hslTotalBalance = $hslTotalAmount;

        // Get total balance of all loans
        foreach ($loans as $loan) {
            if(isset($totalPaymentMPL) && isset($totalPaymentMPL[$loan->id])){
            $mplTotalBalance -= $totalPaymentMPL[$loan->id];
        }
        if(isset($totalPaymentHSL) && isset($totalPaymentHSL[$loan->id])){
            $hslTotalBalance -= $totalPaymentHSL[$loan->id];
            }
        }

        // Check if all MPL loans have been paid 50%
        $allMPLPaid50Percent = $mplLoans->isEmpty() || $mplLoans->every(function ($loan) use ($totalPaymentsMPL) {
            return isset($totalPaymentsMPL[$loan->id]) && $totalPaymentsMPL[$loan->id] >= 0.5 * ($loan->principal_amount + $loan->interest);
        });

        // Check if all HSL loans have been paid 50%
        $allHSLPaid50Percent = $hslLoans->isEmpty() || $hslLoans->every(function ($loan) use ($totalPaymentsHSL) {
            return isset($totalPaymentsHSL[$loan->id]) && $totalPaymentsHSL[$loan->id] >= 0.5 * ($loan->principal_amount + $loan->interest);
        });

        // Determine if the MPL and HSL apply buttons should be disabled
        // MPL is disabled if there is an active loan or if all MPL loans have not been paid 50% and
        $mplDisabled = !empty($inActiveLoan) || !$allMPLPaid50Percent && ($additionalLoan == 0 || $additionalLoan == null || $additionalLoan == 2 && $additionalLoan != 3);
        $hslDisabled = !empty($inActiveLoan) || !$allHSLPaid50Percent && ($additionalLoan == 0 || $additionalLoan == null || $additionalLoan == 1 && $additionalLoan != 3);

        return view('member-views.member-dashboard', [
            'additionalLoan' => $additionalLoan,
            'mplLoans' => $mplLoans,
            'hslLoans' => $hslLoans,
            'loans' => $loans,
            'inActiveLoan' => $inActiveLoan,
            'transactions' => $transactions,
            'transactionPayments' => $transactionPayments,
            'transactionLoans' => $transactionLoans,
            'totalPaymentMPL' => $totalPaymentsMPL,
            'totalPaymentHSL' => $totalPaymentsHSL,
            'mplDisabled' => $mplDisabled,
            'hslDisabled' => $hslDisabled,
        ]);
    }

    public function updateMembership(Request $request, Member $member){
       $beneficiaries=Beneficiary::where('member_id', Auth::user()->id)->orderBy('id', 'asc')->get();

       if($member->user_id != auth()->id()) {
        abort(403, 'Unauthorized Action');
        }
        $formFields = $request->validate([

            // 'campus_id'=> 'required', // naka comment out muna - - need pa seeders
            'unit_id'=> 'required', // naka comment out muna - - need pa seederss
            'firstname'=> 'required',
            'lastname'=> 'required',

            'agree_to_terms'=> 'nullable',

            'middle_initial'=> 'nullable',
            'middlename'=> 'nullable',

            'contact_num'=> 'required',

            'address'=> 'required',
            'date_of_birth'=> 'required',
            'tin_num'=> 'required',
            'position'=> 'required',

            'employee_num'=> 'required',
            'bu_appointment_date'=> 'required',

            'place_of_birth'=> 'nullable',
            'civil_status'=> 'required',

            'spouse'=> 'nullable',

            'sex'=> 'required',
            'monthly_salary'=> 'required',
            'monthly_contribution'=> 'required',
            'appointment_status'=> 'required',

            'profile_picture'=> 'nullable|image|mimes:jpeg,png|max:2048',

            'agree_to_certify'=> 'required',
            'agree_to_authorize'=> 'required',

            'beneficiary0'=> 'required',
            'beneficiary_birthday0'=> 'required',
            'beneficiary_relationship0'=> 'required',
        ]);
        // for profile pic validation
        if($request->hasFile('profile_picture')) {
            $formFields['profile_picture'] = $request->file('profile_picture')->store('profile_picture', 'public');
        }


       for ($i = 0; $i < 5; $i++) {
        if (isset($beneficiaries[$i])) {
            $beneficiary = $beneficiaries[$i];
        } else if ($request->filled("beneficiary{$i}")) {
            $beneficiary = new Beneficiary();
            $beneficiary->member_id = $member->id;
        }
        else {
            continue; // Skip iteration if no beneficiary data present
        }
        if($request->input("beneficiary{$i}")){
            $beneficiary->beneficiary_name = $request->input("beneficiary{$i}");
            $beneficiary->birthday = $request->input("beneficiary_birthday{$i}");
            $beneficiary->relationship = $request->input("beneficiary_relationship{$i}");
            $beneficiary->save();
        }
        else{
            return redirect()->back()->with('error', 'Please provide names for all beneficiaries. If not, the other fields will be cleared.');
        }
        }
        $temp = '+63'.$formFields['contact_num'];
        $formFields['contact_num'] = $temp;

        $member->update($formFields);

        if($formFields['middlename'] != null){
            $member->middle_initial = ucfirst($formFields['middlename'][0]);
            $member->save();
        }

        return redirect('/member/membership-form/edit-download')->with('message', 'Membership Saved');
    }




    public function membershipFormEditDownload(){
        return view('member-views.membership-form.membership-download-edit');
    }


    //show membership form
    public function membershipForm(){
        //gets all the units along with the related campus
        $units = Unit::with('campuses')->get();

        $units = collect($units)->sortBy('unit_code')->values()->all();


        //return view with units variable.
        $relationship_types = BeneficiaryRelationship::all();

        return view('member-views.membership-form.membership_form', compact('units', 'relationship_types'));
    }

    //SHOW form view for editing membership
    public function membershipFormEdit(){
        //gets all the units along with the related campus
        $units = Unit::with('campuses')->get();

        //return view with units variable.
        $relationship_types = BeneficiaryRelationship::all();

        $beneficiaries=Beneficiary::where('member_id', Auth::user()->id)->orderBy('id', 'asc')->get();

        return view('member-views.membership-form-edit.membership_form', compact('units', 'relationship_types', 'beneficiaries'));
    }
    public function createMembership(Request $request, Member $member){
        //Ensure that user is logged in
        if($member->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        $formFields = $request->validate([

            // 'campus_id'=> 'required', // naka comment out muna - - need pa seeders
            'unit_id'=> 'required', // naka comment out muna - - need pa seederss
            'firstname'=> 'required',
            'lastname'=> 'required',

            'agree_to_terms'=> 'nullable',

            'middlename'=> 'nullable',
            'middle_initial'=> 'nullable',

            'contact_num'=> 'nullable',

            'address'=> 'required',
            'date_of_birth'=> 'required',
            'tin_num'=> 'required',
            'position'=> 'required',

            'employee_num'=> 'required',
            'bu_appointment_date'=> 'required',

            'place_of_birth'=> 'nullable',
            'civil_status'=> 'required',

            'spouse'=> 'nullable',

            'sex'=> 'required',
            'monthly_salary'=> 'required',
            'monthly_contribution'=> 'required',
            'appointment_status'=> 'required',

            'profile_picture'=> 'nullable|image|mimes:jpeg,png|max:2048',

            'agree_to_certify'=> 'required',
            'agree_to_authorize'=> 'required',

            'beneficiary0'=> 'required',
            'beneficiary_birthday0'=> 'required',
            'beneficiary_relationship0'=> 'required',
        ]);

        // for profile pic validation
        if($request->hasFile('profile_picture')) {
            $formFields['profile_picture'] = $request->file('profile_picture')->store('profile_picture', 'public');
        }

        MembershipApplication::create([
            'member_id' => $member->id,
            'ref_number' => Str::uuid()->toString(),
            'status' => 0,
        ]);

        $temp = '+63'.$formFields['contact_num'];
        $formFields['contact_num'] = $temp;

        $member->update($formFields);


        if($formFields['middlename'] != null){
            $member->middle_initial = ucfirst($formFields['middlename'][0]);
            $member->save();
        }


        Beneficiary::create([
            'member_id' => $member->id,
            'beneficiary_name' => $formFields['beneficiary0'],
            'birthday' => $formFields['beneficiary_birthday0'],
            'relationship' => $formFields['beneficiary_relationship0'],
        ]);
        if($request->beneficiary1){
            Beneficiary::create([
                'member_id' => $member->id,
                'beneficiary_name' => $request['beneficiary1'],
                'birthday' => $request['beneficiary_birthday1'],
                'relationship' => $request['beneficiary_relationship1'],
            ]);
        }
        if($request->beneficiary2){
            Beneficiary::create([
                'member_id' => $member->id,
                'beneficiary_name' => $request['beneficiary2'],
                'birthday' => $request['beneficiary_birthday2'],
                'relationship' => $request['beneficiary_relationship2'],
            ]);
        }
        if($request->beneficiary3){
            Beneficiary::create([
                'member_id' => $member->id,
                'beneficiary_name' => $request['beneficiary3'],
                'birthday' => $request['beneficiary_birthday3'],
                'relationship' => $request['beneficiary_relationship3'],
            ]);
        }
        if($request->beneficiary4){
            Beneficiary::create([
                'member_id' => $member->id,
                'beneficiary_name' => $request['beneficiary4'],
                'birthday' => $request['beneficiary_birthday4'],
                'relationship' => $request['beneficiary_relationship4'],
            ]);
        }


        return redirect('/member/membership-form/edit-download')->with('message', 'Membership Form Created');

    }

    public function viewProfile(){
        $id = Auth::user()->member->id;
        $user = User::find($id);
        $member = Member::where('user_id', $id)->first();
        // dd($member);
        $unit = Unit::where('id', $member->unit_id)->first();

        $campus = Campus::where('id', $unit->campus_id)->first();
        $units = Unit::all();
        $campuses = Campus::all();

        return view('member-views.member-profile.profile', [
            'user' => $user,
            'member' => $member,
            'unit'  => $unit,
            'campus' => $campus,
            'units' => $units,
            'campuses' => $campuses,
        ]);
    }

    public function profileUpdate(Request $request, $id){

        $validator = Validator::make($request->all(), [
            'unit_id' => 'required',
            'position' => 'required',
            // IGNORE THE EMAIL ASSOCIATED WITH THE LOGGED IN USER
            'email' => [
                'required',
                'string',
                'email:rfc,dns',
                'max:255',
                Rule::unique('users')->ignore(Auth::user()->id),
                new EmailDomain('bicol-u.edu.ph')
            ],
            'contact_num' => 'required',
            'address' => 'required',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors()->all();
            return redirect('/member/profile')->withErrors($errors);
        }

        $user = User::with('member')->find($id);

        if ($user->email != $request->email) {
            $user->email = $request->input('email');
            // Reset Email to verify it again
            $user->email_verified_at = null;
            $user->sendEmailVerificationNotification();
        }

        $user->save();

        // $user->member->middlename = $request->middlename;
        // $user->member->middle_initial = ucfirst($request->middlename[0]);
        $user->member->unit_id = $request->unit_id;
        $user->member->position = $request->position;
        $user->member->contact_num = $request->contact_num;
        $user->member->address = $request->address;
        $user->member->is_editable = 0;
        $user->member->save();

        // return redirect('/member/profile/'.Auth::user()->id)->with('message', 'Profile Saved!');
        return back()->with('message', 'Profile Saved!');
    }

    public function checkMembershipApplication($member_id){
        $member = MembershipApplication::where('member_id', $member_id)->get();
        if(count($member)===0){
           return redirect('/member/membership-form');
        }
        else{
           return redirect('/member/membership-form/edit-download');
        }
   }

   public function changePassword(Request $request, $member_id){

    $request->validate([
        'old_password' => 'required',
        // 'password'=>'required',
        'password' => ['required', 'string', 'confirmed', 'min:8', 'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d\s])[A-Za-z\d\S]+$/'],
    ]);

    $user = Auth::user();
    if (!Hash::check($request->old_password, $user->password)) {
        return redirect()->route('member.profile')->with('fail', 'The old password is incorrect.');
    }

    $user->password = Hash::make($request->password);
    $user->save();

    return redirect()->route('member.profile')->with('message', 'Password changed successfully.');

}


}// last tag
