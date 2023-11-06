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
        Campus::create([
            'campus_code' => 'Main',
            'campus_address' => 'Legazpi West (Main) Campus'
        ]);
        Campus::create([
            'campus_code' => 'East',
            'campus_address' => 'Legazpi East Campus'
        ]);
        Campus::create([
            'campus_code' => 'Daraga',
            'campus_address' => 'Daraga Campus'
        ]);
        Campus::create([
            'campus_code' => 'Tabaco',
            'campus_address' => 'Tabaco Campus' 
        ]);
        Campus::create([
            'campus_code' => 'Guinobtan',
            'campus_address' => 'Guinobatan Campus'
        ]);
        Campus::create([
            'campus_code' => 'Polangui',
            'campus_address' => 'Polangui Campus'
        ]);
        Campus::create([
            'campus_code' => 'Gubat',
            'campus_address' => 'Gubat Campus'
        ]);

    }
}
