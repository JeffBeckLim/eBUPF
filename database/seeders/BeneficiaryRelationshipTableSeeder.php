<?php

namespace Database\Seeders;

use App\Models\BeneficiaryRelationship;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BeneficiaryRelationshipTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // $table->string('relationship_type');
        BeneficiaryRelationship::create([
            'relationship_type' => 'Father',
        ]);
        BeneficiaryRelationship::create([
            'relationship_type' => 'Mother',
        ]);
        // Create the 'Spouse' relationship
        BeneficiaryRelationship::create([
            'relationship_type' => 'Spouse',
        ]);

        // Create the 'Child' relationship
        BeneficiaryRelationship::create([
            'relationship_type' => 'Child',
        ]);

        // Create the 'Parent' relationship
        BeneficiaryRelationship::create([
            'relationship_type' => 'Parent',
        ]);

        // Create the 'Sibling' relationship
        BeneficiaryRelationship::create([
            'relationship_type' => 'Sibling',
        ]);

        // Create the 'Grandparent' relationship
        BeneficiaryRelationship::create([
            'relationship_type' => 'Grandparent',
        ]);

        // Create the 'Grandchild' relationship
        BeneficiaryRelationship::create([
            'relationship_type' => 'Grandchild',
        ]);

        // Create the 'Friend' relationship
        BeneficiaryRelationship::create([
            'relationship_type' => 'Friend',
        ]);

        // Create the 'Relative' relationship
        BeneficiaryRelationship::create([
            'relationship_type' => 'Relative',
        ]);

        // Create the 'Partner' relationship
        BeneficiaryRelationship::create([
            'relationship_type' => 'Partner',
        ]);

        // Create the 'Colleague' relationship
        BeneficiaryRelationship::create([
            'relationship_type' => 'Colleague',
        ]);
    }
}
