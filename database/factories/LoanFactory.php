<?php

namespace Database\Factories;

use App\Models\Loan;
use App\Models\LoanType;
use Faker\Provider\Base;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    

     public function generateId($loanTypeId){
        $loanType = LoanType::find($loanTypeId);
        do {
            $currentDateTime = now();
            // Format date and time to create a string
            $dateTimeString = $currentDateTime->format('Y-j-');
            $randomString = strtoupper(Str::random(3));
            $randomString1 = strtoupper(Str::random(3));
            // Combine the formatted date/time and the random string to create a unique ID
            $uniqueId = $loanType->loan_type_name."-". $dateTimeString . $randomString . "-" . $randomString1;
        } while (Loan::where('loan_code', $uniqueId)->exists());

        return($uniqueId);
    }
     
    public function definition(): array
    {
        $member_ids_seeded = [1, 2, 3, 4, 5, 6];
        $loanType_ids_seeded = [1, 2];
        
        $random_loan_type_id = $loanType_ids_seeded[array_rand($loanType_ids_seeded)];
        $code =  $this->generateId($random_loan_type_id);

        $principal_amount= [];
        for($i=50000; $i != 200000; $i+=10000){
            array_push($principal_amount, $i);
        }
        return [
            // 'loan_code' => $this->faker->unique()->uuid,
            
            'member_id'=>$member_ids_seeded[array_rand($member_ids_seeded)],

            
            'loan_type_id'=>$random_loan_type_id,

            'loan_code' => $code,

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
