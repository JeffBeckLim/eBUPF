<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    //belongs to one member
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    //has many co Borrower but only one is required 
    public function co_borrower()
    {
        return $this->hasMany(CoBorrower::class);
    }

    //has many witness 
    public function witness()
    {
        return $this->hasMany(Witness::class);
    }

    // loan has many payments
    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

}
