<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_category_name',
        'loan_category_description',
    ];

    // Loan categories have many loans

    public function loans(){
        return $this->hasMany(Loan::class);
    }
}
