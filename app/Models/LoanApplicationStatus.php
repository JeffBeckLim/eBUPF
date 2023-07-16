<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanApplicationStatus extends Model
{
    use HasFactory;

    public function loanApplicationState(){
        return $this->belongsTo(LoanApplicationState::class);
    }

    public function loan(){
        return $this->belongsTo(loan::class);
    }
}
