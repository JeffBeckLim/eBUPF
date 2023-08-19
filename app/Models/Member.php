<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;

    protected $table = "members";

    protected $fillable = [
        'user_id',
        'campus_id',
        'unit_id',
        'firstname',
        'lastname',
        'agree_to_terms',
        'middle_initial',
        'contact_num',
        'address',
        'date_of_birth',
        'tin_num',
        'position',
        'verified_at',
        'updated_at',
        'disabled_at',
        'employee_num',
        'bu_appointment_date',

        'place_of_birth',
        'civil_status',
        'spouse',
        'sex',
        'monthly_salary',  
        'monthly_contribution',  
        'appointment_status', 
        'profile_picture',

        'agree_to_certify',
        'agree_to_authorize',
    ];
    // has one user account
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // has many user benifactors
    // public function benificiaries(){
    //     return $this->hasMany(Benificiary::class);
    // }
    public function beneficiaries(){
        return $this->hasMany(Beneficiary::class);
    }

    // has one Membership Application
    public function membershipApplication()
    {
        return $this->hasOne(MembershipApplication::class);
    }

    // has one Unit
    public function units()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
    // has one Campus
    public function campus()
    {
        return $this->belongsTo(Campus::class, 'campus_id', 'id');
    }
    //can be a witness many times
    public function witness()
    {
        return $this->hasMany(Witness::class, 'member_id', 'id');
    }
    //can be a coBorrwer many times
    public function co_borrower()
    {
        return $this->hasMany(CoBorrower::class, 'member_id' , 'id');
    }
    public function loans()
    {
        return $this->hasMany(Loans::class, 'member_id', 'id');
    }

}
