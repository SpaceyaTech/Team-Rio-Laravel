<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Session;

class PostsController extends Controller
{
   // persist a resource in storage
   public function store(PostRequest $request)
   {
      $data = $request->validated();
      $post = Post::create($data);

      //return response
      return response()->json(
        [
            "status" => 1,
            "message" => "Post created successfully",
            "data" => $post

        ]
    );

   }
       

        

        
}