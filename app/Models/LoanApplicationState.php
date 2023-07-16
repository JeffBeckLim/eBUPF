<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanApplicationState extends Model
{
    use HasFactory;

    // state has many states
    public function loanApplicationStatus(){
        return $this->hasMany(LoanApplicationStatus::class);
    }
}
