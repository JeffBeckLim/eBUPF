<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'loan_type_id',

        'loan_code', //secondary unique identifier

        'amortization_id',
        'adjustment_id',
        'loan_category_id',

        'principal_amount',
        'original_principal_amount',

        'interest', 
        'term_years',
        'is_visible',
        'is_active',
        'is_viewed',

        'penalty_id',
        'deleted_at',
        'last_edited_by',

        'reason_for_cancel'
    ];
    //belongs to one member
    public function member()
    {
        // return $this->belongsTo(Member::class, 'member_id', 'id');
        return $this->belongsTo(Member::class);
    }

    //has many co Borrower but only one is required 
    public function co_borrower()
    {
        return $this->hasMany(CoBorrower::class, 'loan_id' , 'id');
    }

    //has many witness 
    public function witness()
    {
        return $this->hasMany(Witness::class, 'loan_id', 'id');
    }

    // loan has many payments
    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    // has one amortization
     public function amortization()
     {
         return $this->hasOne(Amortization::class, 'id', 'amortization_id');
     } 

    //  has one adjustment table
     public function adjustment()
     {
        return $this->hasOne(Adjustment::class , 'id' , 'adjustment_id');
     }

    //  belongs to category of a loan
     public function LoanCategory(){
        return $this->belongsTo(LoanCategory::class);
    }

    // belongs to a type of a loan
    public function LoanType(){
        return $this->belongsTo(LoanType::class, 'loan_type_id', 'id');
    }

    public function loanApplicationStatus(){
        return $this->hasMany(LoanApplicationStatus::class);
    }

    public function check()
    {
        return $this->hasMany(Check::class, 'loan_id' , 'id');
    }

    // loan can has one penalty
    public function penalty()
     {
         return $this->hasOne(Penalty::class, 'id', 'penalty_id');
     } 

}
