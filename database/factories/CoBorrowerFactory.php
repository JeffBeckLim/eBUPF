<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CoBorrower>
 */
class CoBorrowerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $number = 0;

        $member_ids_seeded = [1, 2, 3, 4, 5, 6];
        return [
            'member_id'=>$member_ids_seeded[array_rand($member_ids_seeded)],
            'loan_id'=>$number+=1,
            'accept_request'=>1,
            
        ];
    }
}
