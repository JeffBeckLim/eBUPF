<?php

namespace Database\Seeders;

use App\Models\Campus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CampusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $table->id();
        // $table->timestamps();
        
        // // $table->foreignId('unit_id')->constrained('units');

        // $table->string('campus_code')->nullable();
        // $table->string('campus_address')->nullable();
        
        // [Main : East : Daraga : Tabaco : Guinobatan :   
        // Polangui : Gubat ]

        Campus::create([
            'campus_code' => 'Main',
            'campus_address' => 'Legazpi'
        ]);
        Campus::create([
            'campus_code' => 'East',
            'campus_address' => 'Legazpi'
        ]);
        Campus::create([
            'campus_code' => 'Daraga',
            'campus_address' => 'Daraga'
        ]);
        Campus::create([
            'campus_code' => 'Tabaco',
            'campus_address' => 'Tabaco'
        ]);
        Campus::create([
            'campus_code' => 'Guinobtan',
            'campus_address' => 'Guinobatan'
        ]);
        Campus::create([
            'campus_code' => 'Polangui',
            'campus_address' => 'Polangui'
        ]);
        Campus::create([
            'campus_code' => 'Gubat',
            'campus_address' => 'Gubat'
        ]);

    }
}
