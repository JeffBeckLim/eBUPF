<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        return view('admin-views.admin-dashboard');

    }

    public function allUsers(){

        $users = User::with('member')->get();
        return view('admin-views.admin-all-accounts', compact('users'));


    }


    public function memberLedger(){

        return view('admin-views.admin-ledger');
    }

    public function showRemittance(){
        return view('admin-views.admin-remittance');
    }

}

