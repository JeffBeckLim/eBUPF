<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_id_log',
        'loan_code_log',
        'loan_type_log',
        'loan_category_log',
        'principal_amount_log',
        'interest_log',
        'is_active_log',
        'term_years_log',
        'deleted_at_log',

        'create_update_or_delete',
        'updated_by',

       
    ];
}
