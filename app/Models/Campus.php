<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends Model
{
    use HasFactory;

    protected $table = "campuses";
    
    public function units()
    {
        return $this->hasMany(Unit::class);
    }

    // public function members()
    // {
    //     return $this->hasMany(Member::class);
    // }
}
