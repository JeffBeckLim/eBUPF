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
        
        'adjusted_net_pay', 
        'remarks',
        'check_co',
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class, 'loan_id' , 'id');
    }
}
