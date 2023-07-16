<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdjustmentLog extends Model
{
    use HasFactory;

    public function adjustment(){
        return $this->belongsTo(Adjustment::class);
    }
}
