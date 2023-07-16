<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanType extends Model
{
    use HasFactory;

    // loan types can have many loans
    public function loans(){
        return $this->hasMany(Loan::class);
    }
}
