<?php

namespace App\Http\Controllers;

use App\Models\MembershipApplication;
use Illuminate\Http\Request;

class MembershipApplicationController extends Controller
{
    public function show(){

        $memberApplications = MembershipApplication::with('member.units.campuses')->orderBy('created_at', 'desc')->get();
        
        $pending = count(MembershipApplication::where('status', 0)->get());
        $approved = count(MembershipApplication::where('status', 1)->get());
        $denied = count(MembershipApplication::where('status', 2)->get());
    
        return view(
            'admin-views.admin-membership-applications.admin-membership-applications', 
            compact('memberApplications', 'approved', 'denied', 'pending')
        );
    }


    public function acceptMembership($id){
        dd($id);
    }

    public function rejectMembership($id){
        dd($id);
    }



}
