<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanApplicationStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id',
        'loan_application_state_id',
        'date_evaluated',
        'remarks',
        'deleted_at',
    ];


    public function loanApplicationState(){
        return $this->belongsTo(LoanApplicationState::class);
    }

    public function loan(){
        return $this->belongsTo(loan::class);
    }
}
