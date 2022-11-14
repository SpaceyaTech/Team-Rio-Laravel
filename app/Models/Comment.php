<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
'content',
'account_id',
'post_id',
'comment_id'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }
    
    public function posts()
    {
        return $this->belongsTo(Post::class);
    }

    //self referance

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function reaction()
    {
        return $this->hasMany(Reaction::class);
    }
}
