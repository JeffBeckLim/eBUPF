<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Member;
use App\Models\Payment;
use App\Models\Loan;
use App\Models\User;
use SplFileObject;

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
                        'password' => bcrypt('password123'), // default password for all users
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
                    Member::create($memberData);
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

        if ($request->hasFile('csv_file')) {
            $file = $request->file('csv_file');
            $csv = new SplFileObject($file->getRealPath());
            $csv->setFlags(SplFileObject::READ_CSV);

            $headerSkipped = false;
            $lineNumber = 0;

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
                }
                else{
                    return redirect()->back()->with('error', 'Please check on line '.$lineNumber.' in the CSV file. The loan ID does not exist.');
                }
            }
            //save all payments to the database
            Payment::insert($paymentTable);

            return redirect()->back()->with('success', 'Successfully imported batch payment.');
        }
        return redirect()->back()->with('error', 'No file was imported.');
    }
}
