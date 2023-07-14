<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    // Show log in page
    public function login(){
        return view('auth.login');
    }

    // Show register page
    public function create(){
        return view('auth.register');
    }

     // Create New User
     public function store(Request $request) {
        $validatedData = $request->validate([
            'firstname' => ['required'],
            'lastname' => ['required'],
            'agree_to_terms' => ['required', 'accepted'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6',
        ]);
        // hash password first
        $validatedData['password'] = Hash::make($validatedData['password']);

        // create user email password only
        $user = User::create([
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
        ]);

        // create the members table with the user id as foreign key
        Member::create([
            'users_id' => $user->id,
            'firstname' => $validatedData['firstname'],
            'lastname' => $validatedData['lastname'],
            'agree_to_terms' => $validatedData['agree_to_terms'],
        ]);

        return redirect('/login')->with('message', 'Account Registered! Please Login');
    }


}
