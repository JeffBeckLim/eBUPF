<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Member;
use App\Models\Payment;
use App\Models\Loan;
use App\Models\User;
use SplFileObject;
use App\Mail\ImportedMember;
use Illuminate\Support\Facades\Mail;
use App\Mail\SuccessfulPayment;
use App\Mail\PaidLoan;
use Carbon\Carbon;

class AdminImportData extends Controller
{
    public function importData(){
        return view('admin-views.import-data');
    }

    public function executeImportData(Request $request){

        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv', // validation rules for file
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file');
            $csv = new SplFileObject($file->getRealPath());
            $csv->setFlags(SplFileObject::READ_CSV);

            $headerSkipped = false;

            foreach ($csv as $row) {
                if (!$headerSkipped) {
                    $headerSkipped = true;
                    continue; // Skip the header row
                }

                if($row[0] == null){
                    break;
                }
                $email = $row[0] ?? null;

                $existingUser = User::where('email', $email)->first();
                // Process each row and format data accordingly
                if(!$existingUser){

                    $userData = [
                        'email' => $row[0] ?? null,
                        'email_verified_at' => now(),
                        'password' => bcrypt('Ch@ngeMe123'), // default password for all users
                        'user_type' => 'member', // all users are members
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                    $user = User::create($userData);
                    $user->markEmailAsVerified();
                    $memberData = [
                        'created_at' => now(),
                        'updated_at' => now(),
                        'unit_id' => $row[1] ?? null,
                        'user_id' => $user->id,
                        'firstname' => $row[2] ?? null,
                        'middlename' => $row[3] ?? null,
                        'lastname' => $row[4] ?? null,
                        'agree_to_terms' => '1',
                        'contact_num' => '+63' . $row[5] ?? null,
                        'address' => $row[6] ?? null,
                        'date_of_birth' => $row[7] ?? null,
                        'tin_num' => $row[8] ?? null,
                        'position' => $row[9] ?? null,
                        'verified_at' => now(),
                        'employee_num' => $row[10] ?? null,
                        'bu_appointment_date' => $row[11] ?? null,
                        'place_of_birth' => $row[12] ?? null,
                        'civil_status' => $row[13] ?? null,
                        'spouse' => $row[14] ?? null,
                        'sex' => $row[15] ?? null,
                        'monthly_salary' => $row[16] ?? null,
                        'monthly_contribution' => $row[17] ?? null,
                        'appointment_status' => $row[18] ?? null,
                        'agree_to_certify' => '1',
                        'agree_to_authorize' => '1',
                        'additional_loan' => null,
                        'is_editable' => '1',
                    ];
                    $member = Member::create($memberData);

                    Mail::to($user->email)->send(new ImportedMember($member, $user));
                    $userTable[] = $userData;
                    $memberTable[] = $memberData;
                }
                else{
                    return redirect()->back()->with('error', 'Emails already exists.');
                }
            }
            return redirect()->back()->with('success', 'Members data was imported successfully.');
        }
        return redirect()->back()->with('error', 'No file was imported.');
    }

    public function importRemittanceView(){
        return view('admin-views.admin-loan-remittance.admin-import-csv-payment');
    }

    public function importRemittancePayment(Request $request){

        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv', // validation rules for file
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv', // validation rules for file
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $file = $request->file('csv_file'); // Adjusted to use 'csv_file' instead of 'file'
        $filePath = $file->getPathname();

        $handle = fopen($filePath, 'r');
        $firstRow = fgetcsv($handle);

        $expectedColumnCount = 5;

        if (count($firstRow) > $expectedColumnCount) {
            fclose($handle);
            return redirect()->back()->with('error', 'Uploaded file has more columns than expected.');
        }


        // Process the file further if it passes the column count check

        fclose($handle);

        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file');
            $csv = new SplFileObject($file->getRealPath());
            $csv->setFlags(SplFileObject::READ_CSV);

            $headerSkipped = false;
            $lineNumber = 0;
            $LoanBalance = 0;
            $totalLoanPayment = 0;

            foreach ($csv as $row) {
                if (!$headerSkipped) {
                    $headerSkipped = true;
                    continue; // Skip the header row
                }

                if($row[0] == null){
                    break;
                }
                $lineNumber++;

                $loanID = $row[1];
                $loan = Loan::find($loanID);

                if($loan){
                    $memberID = $loan->member_id;

                    $payment = [
                        'created_at' => now(),
                        'updated_at' => now(),
                        'member_id' => $memberID,
                        'or_number' => $row[0],
                        'loan_id' => $row[1],
                        'principal' => $row[2],
                        'interest' => $row[3],
                        'payment_date' => $row[4],
                    ];
                    //save payment to an array
                    $paymentTable[] = $payment;

                    foreach($paymentTable as $payment){
                        $totalLoanPayment = Payment::where('loan_id', $payment['loan_id'])->sum('principal') + Payment::where('loan_id', $payment['loan_id'])->sum('interest') + $payment['principal'] + $payment['interest'];
                        $loanBalance = ($loan->principal_amount + $loan->interest) - $totalLoanPayment;

                        // If the payment is greater than the loan balance, return an error
                        if($payment['principal'] + $payment['interest'] > $loanBalance){
                            return redirect()->back()->with('error', 'Please check on line '.$lineNumber.' in the CSV file. The payment is greater than the loan balance.');
                        }

                        //Calculate the total loan payment made using the loan_id and the principal and interest
                        // get the total payment for principal
                        $totalPrincipalPayment = Payment::where('loan_id', $payment['loan_id'])->sum('principal');

                        // get the total payment for interest
                        $totalInterestPayment = Payment::where('loan_id', $payment['loan_id'])->sum('interest');

                        // Check if the payment exceeds with the loan balance
                        if($loanBalance - ($payment['principal'] + $payment['interest']) < 0){
                            return redirect()->back()->with('error', 'On line '.$lineNumber.', The payment exceeds loan balance.');
                        }elseif($loan->principal_amount - ($totalPrincipalPayment + $payment['principal']) < 0){
                            return redirect()->back()->with('error', 'On line '.$lineNumber.', the Principal payment exceeds principal balance.');
                        }elseif($loan->interest - ($totalInterestPayment + $payment['interest']) < 0){
                            return redirect()->back()->with('error', 'On line '.$lineNumber.', the interest payment exceeds interest balance.');
                        }
                    }
                }
                else{
                    return redirect()->back()->with('error', 'Please check on line '.$lineNumber.' in the CSV file. The loan ID does not exist.');
                }
            }


        foreach($paymentTable as $payment){

                $totalPayment = Payment::where('loan_id', $payment['loan_id'])->sum('principal') + Payment::where('loan_id', $payment['loan_id'])->sum('interest');
                $loanBalance = ($loan->principal_amount + $loan->interest) - $totalPayment;

                // get the totall  oanpayment and loanbalance
                $member = Member::find($payment['member_id']);
                $loan = Loan::find($payment['loan_id']);
                $principal_amount = $payment['principal'];
                $interest = $payment['interest'];
                $date = Carbon::parse($payment['payment_date'])->format('F d, Y');
                $OR_number = $payment['or_number'];
                $loan_type = $loan->loanType->loan_type_name;

                //if the loan balance is 0, set the loan to non-performing
                if($loanBalance - ($payment['principal'] + $payment['interest']) <= 0){
                    Mail::to($member->user->email)->send(new PaidLoan($member, $loan_type, $loan, $date));
                    $loan->is_active = 2;
                    $loan->save();
                }

                //save payment
                Payment::create($payment);

                //send email to the member
                Mail::to($member->user->email)->send(new SuccessfulPayment($member, $principal_amount, $interest, $loan, $date, $OR_number));
            }

            return redirect()->back()->with('success', 'Successfully imported batch payment.');
        }
        return redirect()->back()->with('error', 'No file was imported.');
    }
}
