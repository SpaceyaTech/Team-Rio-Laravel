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



}
