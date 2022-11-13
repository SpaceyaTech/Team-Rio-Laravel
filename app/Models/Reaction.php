<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reaction extends Model
{
    use HasFactory;


    protected $fillable = [
       'reaction_type',
       'post_id',
       'comment_id',
       'account_id'

    ];

}
