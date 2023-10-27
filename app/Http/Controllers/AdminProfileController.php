<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    public function show(){
        return view ('admin-views.admin-profile.admin-profile');
    }

    public function update(){
        return view ('admin-views.admin-profile.admin-update-profile');
    }

    public function saveUpdate(Request $request, $member_id){
        
        dd($request);
    }
}
