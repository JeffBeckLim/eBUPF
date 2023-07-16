<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adjustment extends Model
{
    use HasFactory;

    public function loan(){
        return $this->belongsTo(Loan::class);
    }

    // can have many logs
    public function adjustments_log(){
        return $this->hasMany(AdjustmentLog::class);
    }


}
