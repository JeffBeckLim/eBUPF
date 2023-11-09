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

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id_log');
    }

    // Payment is for a loan
    public function loan()
    {
        return $this->belongsTo(Loan::class, 'loan_id_log');
    }

}
