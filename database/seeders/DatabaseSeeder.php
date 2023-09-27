<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\LoanApplicationState;
use App\Models\LoanCategory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(CampusesTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
        $this->call(BeneficiaryRelationshipTableSeeder::class);
        $this->call(MembersTableSeeder::class);
        $this->call(LoanTypesTableSeeder::class);
        $this->call(LoanApplicationStatesSeeder::class);
        $this->call(LoanCategorySeeder::class);
        $this->call(DeveloperAccountSeeder::class);
    }
}
