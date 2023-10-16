<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenaltyPayment extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'member_id',
        'penalty_id',

        'penalty_payment_amount', 
        'payment_date',

        'or_number',
    ];

    // payment is for a penalty
    public function penalty()
    {
        return $this->belongsTo(Penalty::class, 'id', 'penalty_id');
    }

    // belongs to a member
    public function member()
    {
        return $this->belongsTo(Member::class, 'id' , 'member_id');
    }
    
}
