<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmortizationLog extends Model
{
    use HasFactory;

     // Relationship 1 - 1  member
     public function member()
     {
         return $this->belongsTo(Amortization::class, 'amortization_id', 'id');
     }
}
