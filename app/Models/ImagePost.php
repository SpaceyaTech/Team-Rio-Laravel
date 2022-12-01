<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagePost extends Model
{
    use HasFactory;

    protected $fillable = [
       'image_id',
       'post_id'

    ];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function image()
    {
        return $this->hasMany(Image::class);
    }

}
