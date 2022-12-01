<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
            "user_id",
            "account_name" ,
            "image" ,
            "bio_data" ,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reaction()
    {
        return $this->hasMany(Reaction::class);
    }
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
    

  

}
