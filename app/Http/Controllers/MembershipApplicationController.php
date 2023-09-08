<?php

namespace App\Http\Controllers;

use App\Models\Member;
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
        $member = Member::with('user', 'membershipApplication')->where('id',$id)->first();

        // ADD A CONDITION HERE TO CHECK IS THE MEMBERSHIP IS ALREADY BEEN ACCEPTED

        // If the member being updated exists
        if($member == null){
            abort(403,'No Data Found');
        }
        // Save each model and its nested relations
        $member->user->user_type = 'member';
            $member->user->save();
        $member->membershipApplication->status = 1;
            $member->membershipApplication->save();
        $member->verified_at = now();
            $member->save();

        // return with the name of the Member
        return redirect('/admin/membership-applications')->with('success', '<strong>'.$member->firstname.'</strong> is now a member');
    }

    public function rejectMembership($id){
        dd($id);
    }



}
