<?php

namespace Database\Seeders;

use App\Models\LoanCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LoanCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LoanCategory::create([
            'loan_category_name' => 'New',
            'loan_category_description' =>'',
        ]);

        LoanCategory::create([
            'loan_category_name' => 'Renewal',
            'loan_category_description' =>'',
        ]);

        LoanCategory::create([
            'loan_category_name' => 'Additional',
            'loan_category_description' =>'',
        ]);
    }
}
