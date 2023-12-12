<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenaltyPaymentLog extends Model
{
    use HasFactory;

    // protected $table = "penalty_payment_log";

    protected $fillable = [
        'member_id',
        'penalty_id_log',

        'penalty_payment_amount_log',
        'payment_date_log',

        'or_number_log',
    ];

    public function penalty()
    {
        return $this->belongsTo(Penalty::class, 'penalty_id_log', 'id');
    }

    // belongs to a member
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id_log' , 'id');
    }
}
