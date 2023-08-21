<?php

namespace Database\Seeders;

use App\Models\LoanType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoanTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LoanType::create([
            'loan_type_name' => 'MPL',
            'loan_type_description' =>'Multi-purpose Loan',
        ]);

        LoanType::create([
            'loan_type_name' => 'HSL',
            'loan_type_description' =>'Housing Loan',
        ]);
    }
}
