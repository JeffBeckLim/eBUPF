<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = "members";

    protected $fillable = [
        'users_id',
        'firstname',
        'lastname',
        'agree_to_terms',
        'middle_initials',
        'contact_num',
        'address',
        'birthday',
        'tin_num',
        'position',
        // 'created_at'
        'verified_at',
        'updated_at',
        'disabled_at',
        'employee_num',
        'bu_appointment_date',
    ];
    // has one user account
    public function users(){
        return $this->belongsTo(User::class);
    }

    // has many user benifactors
    public function benificiaries(){
        return $this->hasMany(Benificiary::class);
    }

    // has one Membership Application
    public function membershipApplication()
    {
        return $this->hasOne(MembershipApplication::class);
    }

    // has one Unit
    public function units()
    {
        return $this->belongsTo(Unit::class);
    }
    // has one Campus
    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }
    //can be a witness many times
    public function witness()
    {
        return $this->hasMany(Witness::class);
    }
    //can be a coBorrwer many times
    public function co_borrower()
    {
        return $this->hasMany(CoBorrower::class);
    }
    public function loans()
    {
        return $this->hasMany(Loans::class);
    }

}
