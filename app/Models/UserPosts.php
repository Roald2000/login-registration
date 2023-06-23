<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class UserPosts extends Model
{
    use HasFactory;
    protected $table = "userposts";
    protected $fillable = [
        'title',
        'body',
        'audience',
        'author' //? The Authenticated User Id
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
}
