<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // [GASS : AUXILIARY : GS : CSSP : CBEM : CN : CE : 
        // CENG : CIT : CAF : TC : PC : CAL : CS : IPESR : RESEARCH : EXTENSION : CM]	
        // $table->foreignId('campus_id')->constrained('campuses');
        // $table->string('unit_code')->nullable();
        // $table->string('unit_address')->nullable();
        Unit::create([
            'campus_id' => '1',
            'unit_code' => 'GASS',
            'unit_address' => '',
        ]);
        Unit::create([
            'campus_id' => '1',
            'unit_code' => 'AUXILIARY',
            'unit_address' => '',
        ]);
        Unit::create([
            'campus_id' => '1',
            'unit_code' => 'GS',
            'unit_address' => '',
        ]);
        Unit::create([
            'campus_id' => '3',
            'unit_code' => 'CSSP',
            'unit_address' => '',
        ]);
        Unit::create([
            'campus_id' => '3',
            'unit_code' => 'CBEM',
            'unit_address' => '',
        ]);
        Unit::create([
            'campus_id' => '1',
            'unit_code' => 'CN',
            'unit_address' => '',
        ]);
        Unit::create([
            'campus_id' => '1',
            'unit_code' => 'CE',
            'unit_address' => '',
        ]);
        Unit::create([
            'campus_id' => '2',
            'unit_code' => 'CENG',
            'unit_address' => '',
        ]);
        Unit::create([
            'campus_id' => '2',
            'unit_code' => 'CIT',
            'unit_address' => '',
        ]);
        Unit::create([
            'campus_id' => '5',
            'unit_code' => 'CAF',
            'unit_address' => '',
        ]);
        Unit::create([
            'campus_id' => '4',
            'unit_code' => 'TC',
            'unit_address' => '',
        ]);
        Unit::create([
            'campus_id' => '6',
            'unit_code' => 'PC',
            'unit_address' => '',
        ]);
        Unit::create([
            'campus_id' => '1',
            'unit_code' => 'CAL',
            'unit_address' => '',
        ]);
        Unit::create([
            'campus_id' => '1',
            'unit_code' => 'CS',
            'unit_address' => '',
        ]);
        Unit::create([
            'campus_id' => '1',
            'unit_code' => 'IPESR',
            'unit_address' => '',
        ]);
        Unit::create([
            'campus_id' => '1',
            'unit_code' => 'RESEARCH',
            'unit_address' => '',
        ]);
        Unit::create([
            'campus_id' => '1',
            'unit_code' => 'EXTENSION',
            'unit_address' => '',
        ]);
        Unit::create([
            'campus_id' => '1',
            'unit_code' => 'CM',
            'unit_address' => '',
        ]);

    }
}
