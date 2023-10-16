<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    use HasFactory;

    protected $fillable = [
        'penalty_total',
        'penalized_months',
        'penalty_rate', 
    ];

    // penalty belongs to a loan
    public function loan(){
        return $this->belongsTo(Loan::class, 'penalty_id', 'id');
    }

    // penalty has many penalty payments
    public function penalty_payment(){
        return $this->hasMany(PenaltyPayment::class, 'penalty_id' ,'id');
    }
}
