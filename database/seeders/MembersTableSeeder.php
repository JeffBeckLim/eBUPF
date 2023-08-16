<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Member::create([
            'unit_id'=> '1', // naka comment out muna - - need pa seederss
            'firstname'=> 'Paul',
            'lastname'=> 'MCartney',

            'agree_to_terms'=> '1',

            'middle_initial'=> '1',

            'contact_num'=> '',

            'address'=> 'New York',
        ]);
        Member::create([
            'unit_id'=> '2', // naka comment out muna - - need pa seederss
            'firstname'=> 'Jon Jones',
            'lastname'=> 'MCartney',

            'agree_to_terms'=> '1',

            'middle_initial'=> '1',

            'contact_num'=> '',

            'address'=> 'New York',
        ]);
    }
}
