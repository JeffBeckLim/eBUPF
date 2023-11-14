<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmortizationLog extends Model
{
    use HasFactory;


    protected $fillable = [

        'loan_id_log',
        'loan_code_log',

        'amort_principal_log', 
        'amort_interest_log', 

        'amort_start_log', 
        'amort_end_log', 

        'changes',
        'updated_by',
    ];


     // Relationship 1 - 1  member
    //  public function member()
    //  {
    //      return $this->belongsTo(Amortization::class, 'amortization_id', 'id');
    //  }
}
