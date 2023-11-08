<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'primary_key_log',
        'or_number_log',
        'payment_date_log',
        'loan_id_log',
        'principal_log',
        'interest_log',
        'member_id_log',
    ];
}
