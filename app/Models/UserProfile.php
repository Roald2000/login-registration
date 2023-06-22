<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;
    protected $table = "userprofile";
    protected $fillable = [
        'age',
        'gender',
        'address',
        'contact',
        'user_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
