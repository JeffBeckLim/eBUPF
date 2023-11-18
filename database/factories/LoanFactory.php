<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Provider\Base;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loan>
 */
class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    public function definition(): array
    {
        $member_ids_seeded = [1, 2, 3, 4, 5, 6];
        $loanType_ids_seeded = [1, 2];
        
        $principal_amount= [];
        for($i=50000; $i != 200000; $i+=10000){
            array_push($principal_amount, $i);
        }
        return [
            'loan_code' => $this->faker->unique()->uuid,


            'member_id'=>$member_ids_seeded[array_rand($member_ids_seeded)],

            
            'loan_type_id'=>$loanType_ids_seeded[array_rand($loanType_ids_seeded)],

            // 'amortization_id')->nullable()->constrained('amortizations');
            // 'adjustment_id')->nullable()->constrained('adjustments');
            // 'loan_category_id')->nullable()->constrained('loan_categories');

           'principal_amount'=>$principal_amount[array_rand($principal_amount)],
        //    'original_principal_amount', 20, 2)->nullable(); //this is the original amount requested for reference and cannot be modified

        //    'interest', 20, 2)->nullable();

            'term_years'=>5,
            // $table->integer('is_visible')->nullable();

            // 'is_active')->nullable();

            // 'is_viewed')->nullable();
            

            // 'penalty_id')->nullable()->constrained('penalties');

            // 'deleted_at')->nullable();

            // 'last_edited_by')->nullable();
        ];
    }
}
