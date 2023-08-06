<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beneficiary extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'beneficiary_name',
        'birthday' ,
        'relationship',
    ];

    public function member(){
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
}
