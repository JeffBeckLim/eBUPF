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
        
        //1
        Unit::create([
            'campus_id' => '1',
            'unit_code' => 'GASS',
            'unit_address' => 'BU-General Administration & Support Services',
        ]);
        //2
        Unit::create([
            'campus_id' => '1',
            'unit_code' => 'AUXILIARY',
            'unit_address' => 'BU-Auxiliary Services',
        ]);
        //3
        Unit::create([
            'campus_id' => '1',
            'unit_code' => 'CE',
            'unit_address' => 'BU-College of Education',
        ]);
        //4
        Unit::create([
            'campus_id' => '1',
            'unit_code' => 'IPESR',
            'unit_address' => 'BU-Institute of Physical Education Sports & Recreation',
        ]);
        //5
        Unit::create([
            'campus_id' => '1',
            'unit_code' => 'CM',
            'unit_address' => 'BU-College of Medicine',
        ]);
        //6
        Unit::create([
            'campus_id' => '2',
            'unit_code' => 'CENG',
            'unit_address' => 'BU-College of Engineering',
        ]);
        //7
        Unit::create([
            'campus_id' => '2',
            'unit_code' => 'CIT',
            'unit_address' => 'BU-College of Industrial Technology',
        ]);
        //8
        Unit::create([
            'campus_id' => '1',
            'unit_code' => 'IA',
            'unit_address' => 'BU-Institute of Architecture',
        ]);
        //9
        Unit::create([
            'campus_id' => '1',
            'unit_code' => 'RES',
            'unit_address' => 'BU-Research & Development Management Division',
        ]);
        //10
        Unit::create([
            'campus_id' => '1',
            'unit_code' => 'EXT',
            'unit_address' => 'BU-Extension Management Division',
        ]);
        //11
        Unit::create([
            'campus_id' => '3',
            'unit_code' => 'CBEM',
            'unit_address' => 'BU-College of Business & Management',
        ]);
        //12
        Unit::create([
            'campus_id' => '3',
            'unit_code' => 'CSSP',
            'unit_address' => 'BU-College of Sciences & Philosophy',
        ]);
        //13
        Unit::create([
            'campus_id' => '1',
            'unit_code' => 'CS',
            'unit_address' => 'BU-College of Science',
        ]);
        //14
        Unit::create([
            'campus_id' => '1',
            'unit_code' => 'CN',
            'unit_address' => 'BU-College of Nursing',
        ]);
        //15
        Unit::create([
            'campus_id' => '1',
            'unit_code' => 'GS',
            'unit_address' => 'BU-Graduate School',
        ]);
        //16
        Unit::create([
            'campus_id' => '1',
            'unit_code' => 'CAL',
            'unit_address' => 'BU-College of Arts & Letters',
        ]);
        //17
        Unit::create([
            'campus_id' => '6',
            'unit_code' => 'PC',
            'unit_address' => 'BU-Polangui Campus',
        ]);
        // 18
        Unit::create([
            'campus_id' => '4',
            'unit_code' => 'TC',
            'unit_address' => 'BU Tabaco Campus',
        ]);
       //19
        Unit::create([
            'campus_id' => '5',
            'unit_code' => 'CAF',
            'unit_address' => 'BU College of Agriculture & Forestry',
        ]);
      
       
       
     
        
        
      

    }
}
