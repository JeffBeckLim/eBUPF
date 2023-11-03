<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Witness extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'witness_name',
    ];
    

    //wtiness instance is one member
    // public function member()
    // {
    //     return $this->belongsTo(Member::class, 'member_id', 'id');
    // }
    public function loan()
    {
        return $this->belongsTo(Loan::class, 'loan_id', 'id');
    }
    
}
