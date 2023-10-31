<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\User;
use App\Models\Member;
use App\Rules\EmailDomain;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminCreateMemberController extends Controller
{
    public function show(){
        $units = Unit::all();
        return view('admin-views.admin-create-member.admin-create-member', compact('units'));
    }
    public function create(Request $request){
        $formFields = $request->validate([
            'unit_id'=> 'required', 
            'firstname'=> 'required',
            'lastname'=> 'required',

            'email' => ['required', 'string', 'email:rfc,dns', 'max:255', 'unique:users', new EmailDomain('bicol-u.edu.ph')],
            'password' => ['required', 'string', 'confirmed', 'min:8', 'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z\d\s])[A-Za-z\d\S]+$/'],
            
            'middlename'=> 'nullable',
            
            'contact_num'=> 'required',

            'address'=> 'required',
            'date_of_birth'=> 'required',
            'tin_num'=> 'required',
            'position'=> 'nullable',

            'employee_num'=> 'nullable',
            'bu_appointment_date'=> 'nullable',
            'sex'=> 'required',
            'monthly_salary'=> 'required',
            'appointment_status'=> 'required',
        ]);

        $user=User::create([
            'email' => $formFields['email'],
            'password' => Hash::make($formFields['password']),
            'user_type' => 'member',
        ]);

        $member = Member::create([
            'user_id'=>$user->id,
             
            'firstname' => $formFields['firstname'],
            'lastname' => $formFields['lastname'],
            'middlename'=> $formFields['middlename'],
            
            'contact_num'=> '+63'.$formFields['contact_num'],
            'unit_id'=> $formFields['unit_id'],

            'address'=> $formFields['address'],
            'date_of_birth'=> $formFields['date_of_birth'],
            'tin_num'=> $formFields['tin_num'],
            'position'=> $formFields['position'],

            'employee_num'=> $formFields['employee_num'],
            'bu_appointment_date'=> $formFields['bu_appointment_date'],
            'sex'=> $formFields['sex'],
            'monthly_salary'=> $formFields['monthly_salary'],
            'appointment_status'=> $formFields['appointment_status'],

            'agree_to_terms' =>1,
            'agree_to_certify'=>1,
            'agree_to_authorize'=>1,
        ]);

        if($user != null && $member != null){
            return back()->with('passed','Account Created!');
        }else{
            return back()->with('failed','Something Went Wrong in Creating Member Account');
        }
        

    }
    
}
