<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminCreateMemberController extends Controller
{
    public function show(){
        return view('admin-views.admin-create-member.admin-create-member');
    }
    public function create(Request $request){
       dd($request); 
    }
    
}
