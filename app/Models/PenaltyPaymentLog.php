<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenaltyPaymentLog extends Model
{
    use HasFactory;

    // protected $table = "penalty_payment_log";

    protected $fillable = [
        'member_id_log',
        'penalty_id_log',

        'penalty_payment_amount_log', 
        'payment_date_log',

        'or_number_log',
    ];
}
