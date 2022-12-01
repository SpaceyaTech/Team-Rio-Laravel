<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_name',
        'post_views',
    
    ];


    public function categoryPost()
    {
        return $this->belongsTo(CategoryPost::class);
    }

}
