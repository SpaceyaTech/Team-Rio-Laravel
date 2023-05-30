<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all the posts and save it a variable $posts

        $posts = Post::get();

        //return response and the post data included
        return response()->json(
            [
                "status" => 1,
                "message" => "All Post",
                "data" => $posts
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //validation the data
        $request->validate(
            [
                "post_title" => "required",
                "post_description" => "required",
                "post_content" => "required",
                // "account_id" => "required",

            ]
        );

        //create post with data from the user
        $post = new Post();

        $account = Account::where("user_id",auth()->user()->id)->first();

        $post->post_title = $request->post_title;
        $post->post_description = $request->post_description;
        $post->post_content = $request->post_content;
        $post->account_id =  $account->id ;

        //save the post
        $post->save();


        //send response
        return response()->json(
            [
                "status" => 1,
                "message" => "Post created successfully",
                "data" => $post

            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        //find the post if the post exists then return details in json format
        if (Post::where("id", $id)->exists()) {

            //post details will be details of post matching the id
            $post_details = Post::where("id", $id)->first();

            //return response
            return response()->json(
                [
                    "status" => 1,
                    "message" => "Post found",
                    "details" => $post_details
                ]
            );
        } else {
            //else the post with the id was not found
            return response()->json(
                [
                    "status" => 0,
                    "message" => "Post not found",

                ],
                404
            );
        };
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        //check if post with the id exists

        if (Post::where("id", $id)->exists()) {


            //find the post with the specified id
            $post = Post::find($id);


            //update if updated value if empty(no value to be updated) retain the value that was in the database
            $post->post_title = !empty($request->post_title) ? $request->post_title : $post->post_title;
            $post->post_description = !empty($request->post_description) ? $request->post_description : $post->post_description;
            $post->post_content = !empty($request->post_content) ? $request->post_content : $post->post_content;

            //save the updates
            $post->save();


            //if update was successful return response
            return response()->json([
                "status" => 1,
                "message" => "Post updated successfully",
                "data" => $post

            ]);
        } else {

            //the post with the id specified not found
            return response()->json([
                "status" => 0,
                "message" => "Post not found",

            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //check if post with the id exists

        if (Post::where("id", $id)->exists()) {


            //find the post with the specified id
            $post = Post::find($id);


            //deleting a post
            $post->delete();


            //return response
            return response()->json([
                "status" => 1,
                "message" => "Post deleted successfully",

            ]);
        } else {

            //the Post with the id specified not found
            return response()->json([
                "status" => 0,
                "message" => "Post not found",

            ], 404);
        }
    }
}
