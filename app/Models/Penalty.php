<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'penalty_total',
        'penalized_month',
        'penalized_year',

        'penalty_rate',
    ];

    // penalty belongs to a loan
    public function loan(){
        return $this->belongsTo(Loan::class, 'id', 'loan_id');
    }

    // penalty has many penalty payments
    public function penalty_payment(){
        return $this->hasMany(PenaltyPayment::class, 'penalty_id' ,'id');
    }
}
