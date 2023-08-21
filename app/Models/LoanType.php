<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanType extends Model
{
    use HasFactory;
    protected $fillable = [
        'loan_type_name',
        'loan_type_description',
    ];
    // loan types can have many loans
    public function loans(){
        return $this->hasMany(Loan::class, 'loan_type_id', 'id');
    }
}
