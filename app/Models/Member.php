<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = "members";

    protected $fillable = [
        'users_id',
        'firstname',
        'lastname',
        "agree_to_terms",
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
