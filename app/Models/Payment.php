<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    // Payment belongs to a member

    protected $fillable = [
        'or_number',
        'payment_date',
        'loan_id',
        'principal',
        'interest',
        'member_id',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    // Payment is for a loan
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

}
