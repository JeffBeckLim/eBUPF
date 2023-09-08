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
        
        // If the member being updated exists
        if($member == null){
            abort(403,'No Data Found');
        }

        if($member->user->user_type == 'member'){
            return redirect('/admin/membership-applications')->with('warning', '<strong>'.$member->firstname.'</strong> is already a member!'); 
        }

        // Save each model and its nested relations
        $member->user->user_type = 'member';
            $member->user->save();
        $member->membershipApplication->status = 1;
            $member->membershipApplication->save();
        $member->verified_at = now();
            $member->save();

        // return with the name of the Member
        return redirect('/admin/membership-applications')->with('success', '<strong>'.$member->firstname.'</strong> is now a member!');
    }

    public function rejectMembership($id){

        $member = Member::with('user', 'membershipApplication')->where('id',$id)->first();
        
        // If the member being updated exists
        if($member == null){
            abort(403,'No Data Found');
        }
        if($member->membershipApplication->status == 2){
            return redirect('/admin/membership-applications')->with('reject', '<strong>'.$member->firstname.'</strong> membership application is already been declined!'); 
        }

        if($member->user->user_type == 'member'){
            return redirect('/admin/membership-applications')->with('warning', '<strong>'.$member->firstname.'</strong> is already a member!'); 
        }

        // Save each model and its nested relations
        $member->user->user_type = 'non-member';
            $member->user->save();
        $member->membershipApplication->status = 2; //2 for denied
            $member->membershipApplication->save();
        $member->verified_at = now();
            $member->save();

        // return with the name of the Member
        return redirect('/admin/membership-applications')->with('reject', 'Membership application of <strong>'.$member->firstname.'</strong> is rejected');
    }



} // THIS IS THE LAST TAG
