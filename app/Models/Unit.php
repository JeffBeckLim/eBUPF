<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = "units";

    public function campuses()
    {
        return $this->belongsTo(Campus::class, 'campus_id', 'id');
    }

    public function members()
    {
        return $this->hasMany(Member::class);
    }
}
