<?php

namespace Database\Seeders;

use App\Models\LoanApplicationState;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoanApplicationStatesSeeder extends Seeder
{

    // 'state_name',
    //     'state_description',
    //     'asset_path',
    //     'flag',
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LoanApplicationState::create([
            'state_name' => 'Received by our BUPF Staff',
            'state_description' =>'Your Loan Application now being forwarded to our Loan Analyst',

            'asset_path'=>'assets/status-staff.svg',
            'flag'=>'1',
        ]);
        LoanApplicationState::create([
            'state_name' => 'Reviewed by our Loan Analyst',
            'state_description' =>'Checked and Reviewed for Loan Computations',

            'asset_path'=>'assets/status-loan-analyst.svg',
            'flag'=>'2',
        ]);
        LoanApplicationState::create([
            'state_name' => 'Approved by our Executive Director',
            'state_description' =>'Forwarded back to our staff for check release',

            'asset_path'=>'assets/status-approved-by-director.svg',
            'flag'=>'3',
        ]);
        LoanApplicationState::create([
            'state_name' => 'Your Check is Ready',
            'state_description' =>'Your LPB check is ready for pick-up at BUPF. See requirements Here.',

            'asset_path'=>'assets/status-check-ready.svg',
            'flag'=>'4',
        ]);
        LoanApplicationState::create([
            'state_name' => 'Check Picked Up',
            'state_description' =>'Your check is picked up. See your loans to stay up to date on your       balance and monthly payment',

            'asset_path'=>'assets/check.png',
            'flag'=>'5',
        ]);
        LoanApplicationState::create([
            'state_name' => 'Denied',
            'state_description' =>'Your Loan Application was Denied',
            'asset_path'=>'',
            'flag'=>'6',
        ]);
    }
}
