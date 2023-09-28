<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdjustmentLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'mri', 
        'interest_rebate', 
        'housing_service_fee', 
    ];

    public function adjustment(){
        return $this->belongsTo(Adjustment::class);
    }
}
