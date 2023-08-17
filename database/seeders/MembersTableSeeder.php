<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Member;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::create([
            'email' => 'user1@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'user_type' => 'member',
        ]);

        $user2 = User::create([
            'email' => 'user2@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password456'),
            'user_type' => 'member',
        ]);

        $user3 = User::create([
            'email' => 'user3@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password789'),
            'user_type' => 'member',
        ]);

        $user4 = User::create([
            'email' => 'user4@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('passwordabc'),
            'user_type' => 'member',
        ]);

        $user5 = User::create([
            'email' => 'user5@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('passwordxyz'),
            'user_type' => 'member',
        ]);

        
        Member::create([
            'user_id' => $user1->id,
            'unit_id'=> '1', // naka comment out muna - - need pa seederss
            'firstname'=> 'Paul',
            'lastname'=> 'MCartney',

            'agree_to_terms'=> '1',

            'middle_initial'=> 'J',

            'contact_num'=> '',

            'address'=> 'New York',
        ]);
        Member::create([
            'user_id' => $user2->id,
            'unit_id'=> '2', // naka comment out muna - - need pa seederss
            'firstname'=> 'Jon Jones',
            'lastname'=> 'MCartney',

            'agree_to_terms'=> '1',

            'middle_initial'=> 'M',

            'address'=> 'Liverpool England',
        ]);

        Member::create([
            'user_id' => $user3->id,
            'unit_id'=> '3', // naka comment out muna - - need pa seederss
            'firstname'=> 'Jackson',
            'lastname'=> 'Brown',

            'agree_to_terms'=> '1',

            'middle_initial'=> 'L',

            'address'=> 'Huston Texas',
        ]);

        Member::create([
            'user_id' => $user4->id,
            'unit_id'=> '4', // naka comment out muna - - need pa seederss
            'firstname'=> 'David',
            'lastname'=> 'Bowie',

            'agree_to_terms'=> '1',

            'middle_initial'=> 'F',

            'address'=> 'Mars',
        ]);
        Member::create([
            'user_id' => $user5->id,
            'unit_id'=> '5', // naka comment out muna - - need pa seederss
            'firstname'=> 'Elton',
            'lastname'=> 'John',

            'agree_to_terms'=> '1',

            'middle_initial'=> 'S',

            'address'=> 'Yellow Brick Road',
        ]);
    }
}
