<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdjustmentLog extends Model
{
    use HasFactory;

    protected $table = "adjustments_logs";

    protected $fillable = [

        'loan_id_log',
        'loan_code_log',
        
        'adjustments_id_log',
        'log_col_name',
        'changes',
        'updated_by'
    ];

    // public function adjustment(){
    //     return $this->belongsTo(Adjustment::class);
    // }
}
