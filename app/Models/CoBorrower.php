<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoBorrower extends Model
{
    use HasFactory;
    //CoBorrwer instance is one member
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    // belongs to a loan
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
