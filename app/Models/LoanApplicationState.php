<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanApplicationState extends Model
{
    use HasFactory;

    protected $fillable = [
        'state_name',
        'state_description',
        'asset_path',
        'flag',
    ];

    // state has many states
    public function loanApplicationStatus(){
        return $this->hasMany(LoanApplicationStatus::class);
    }
}
