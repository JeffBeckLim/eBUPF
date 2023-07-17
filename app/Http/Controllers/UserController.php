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
}
