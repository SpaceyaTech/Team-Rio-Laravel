<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;

    protected $fillable = [

        'category_id',
        'post_id'
    ];

    public function category()
    {
        return $this->hasMany(Category::class);
    }
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
