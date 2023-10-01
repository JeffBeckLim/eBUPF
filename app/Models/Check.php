<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',

        'date',
        'number',
        'voucher_num',
        'payee',
        'nature_of_payment',
        
        'gross_amount',
        'net_amount',
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class, 'loan_id' , 'id');
    }
}
