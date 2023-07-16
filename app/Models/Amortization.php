<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amortization extends Model
{
    use HasFactory;

    //amortization belongs to a loan
    public function loan(){
        return $this->belongsTo(Loan::class, 'loan_id', 'id');
    }

     // Has logs
     public function member()
     {
         return $this->hasMany(AmortizationLog::class);
     }


}
