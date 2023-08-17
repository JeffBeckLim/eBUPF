<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoBorrower extends Model
{   

    use HasFactory;

    protected $fillable = [
        'member_id',
        'loan_id',
        'accept_request',
    ];
    
    //CoBorrwer instance is one member
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id' , 'id');
    }

    // belongs to a loan
    public function loan()
    {
        return $this->belongsTo(Loan::class, 'loan_id', 'id');
    }
}
