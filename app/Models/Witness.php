<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Witness extends Model
{
    use HasFactory;

    //wtiness instance is one member
    public function member()
    {
        return $this->belongsTo(Member::class);
    }
    
}
