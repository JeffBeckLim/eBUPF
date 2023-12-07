<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Member;
use App\Models\MembershipApplication;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DeveloperAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'email' => 'harrypotter@bicol-u.edu.ph',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'user_type' => 'member',
        ]);

        $member  = Member::create([
            'user_id' => $user->id,
            'unit_id'=> '1', // naka comment out muna - - need pa seederss
            'firstname'=> 'Harry',
            'lastname'=> 'Potter',

            'date_of_birth'=> now(),

            'agree_to_terms'=> '1',

            // 'middle_initial'=> 'X',

            'contact_num'=> '+639123456780',

            'address'=> 'BUCS / IT DEPT., LEGAZPI, ALBAY, PH',
            'verified_at'=>now(),
            // 'campus_id',

            'tin_num' =>  1111,
            'position' => 'Developer',
            'employee_num' => 1111,
            'bu_appointment_date'=>now(),

            'place_of_birth'=>'BUCS - LEGAZPI, ALBAY, PH',
            'civil_status' => 'single',
            'spouse'=>'',
            'sex'=>'male',
            'monthly_salary'=> 1111,
            'monthly_contribution'=> 300,
            'appointment_status'=> 'regular',
            'profile_picture'=>'',
            'agree_to_certify' => 1,
            'agree_to_authorize' => 1,
        ]);

        MembershipApplication::create([
                'member_id'=>$member->id,
                'ref_number'=>'000000',
                'status'=>'1',
        ]);


        $user = User::create([
            'email' => 'developer-admin@ebupf.com',
            'email_verified_at' => now(),
            'password' => Hash::make('spongebob'),
            'user_type' => 'admin',
        ]);

        $member  = Member::create([
            'user_id' => $user->id,
            'unit_id'=> '1', // naka comment out muna - - need pa seederss
            'firstname'=> 'Developer-Admin',
            'lastname'=> 'Account',

            'date_of_birth'=> now(),

            'agree_to_terms'=> '1',

            // 'middle_initial'=> 'X',

            'contact_num'=> '09123456780',

            'address'=> 'BUCS / IT DEPT., LEGAZPI, ALBAY, PH',
            'verified_at'=>now(),
            // 'campus_id',

            'tin_num' =>  1111,
            'position' => 'Developer',
            'employee_num' => 1111,
            'bu_appointment_date'=>now(),

            'place_of_birth'=>'BUCS - LEGAZPI, ALBAY, PH',
            'civil_status' => 'single',
            'spouse'=>'',
            'sex'=>'male',
            'monthly_salary'=> 1111,
            'monthly_contribution'=> 300,
            'appointment_status'=> 'regular',
            'profile_picture'=>'',
            'agree_to_certify' => 1,
            'agree_to_authorize' => 1,
        ]);

        MembershipApplication::create([
                'member_id'=>$member->id,
                'ref_number'=>'000000',
                'status'=>'1',
        ]);

    }
}
