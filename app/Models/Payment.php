<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    // Payment belongs to a member
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
