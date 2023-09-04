<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipApplication extends Model
{
    use HasFactory;
    protected $fillable = [
        'member_id',
        'ref_number',
        'status',
    ];

    public function member(){
        return $this->belongsTo(Member::class);
    }
}
