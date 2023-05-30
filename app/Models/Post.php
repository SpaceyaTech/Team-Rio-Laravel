<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
       'post_title',
       'post_description',
       'post_content',
       'account_id'



    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function categorypost()
    {
        return $this->hasMany(CategoryPost::class);
    }

    public function imagePost()
    {
        return $this->hasMany(ImagePost::class);
    }

    public function reaction()
    {
        return $this->hasMany(Reaction::class);
    }



}
