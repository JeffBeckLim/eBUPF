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

    // has one amortization
     public function amortization()
     {
         return $this->hasOne(Amortization::class, 'amortization_id', 'id');
     } 

    //  has one adjustment table
     public function adjustment()
     {
        return $this->hasOne(Adjustment::class);
     }

    //  belongs to category of a loan
     public function LoanCategory(){
        return $this->belongsTo(LoanCategory::class);
    }

    // belongs to a type of a loan
    public function LoanType(){
        return $this->belongsTo(LoanType::class);
    }

    public function loanApplicationStatus(){
        return $this->hasMany(LoanApplicationStatus::class);
    }

}
