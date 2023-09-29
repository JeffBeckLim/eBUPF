<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjustment extends Model
{
    use HasFactory;

    protected $fillable = [
        'mri',
        'interest_rebate',
        'previous_loan_balance',
        'interest_first_yr',
        'housing_service_fee',
    ];

    public function loan(){
        return $this->belongsTo(Loan::class, 'adjustment_id' , 'id');
    }

    // can have many logs
    public function adjustments_log(){
        return $this->hasMany(AdjustmentLog::class);
    }


}
