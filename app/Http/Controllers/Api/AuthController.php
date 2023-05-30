<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        //validate data before sending to database
        $validatedData = $request->validate([
            'username' => 'required|max:55|unique:users,username',
            'email' => 'email|required|unique:users',
            'phone_no' => 'required|max:55|unique:users,phone_no',
            'password' => 'required|confirmed'
        ]);

        //hash password so that we won't save plain password
        $validatedData['password'] = bcrypt($request->password);
        //create remember token
        $validatedData['remember_token'] = Str::random();

        //create user
        $user = User::create($validatedData);
        //send verification link
        $user->sendEmailVerificationNotification();

        //return response
        return response()->json(
            [
                "status" => 1,
                "message" => "User created successfully",
                "message 2" => "Email verifiction link has been sent to your email id",
                "data" => $user

            ]
        );
    }




    public function login(Request $request)
    {
        //validate data for login
        $loginData = $request->validate(
            [
                'email' => 'email|required',
                'password' => 'required'
            ]
        );
        //check for credentials
        if (!auth()->attempt($loginData)) {
            return response(
                [
                    "status" => 0,
                    'message' => 'Invalid Credentials'
                ]
            );
        }

        //logged in user data
        $user = auth()->user();

        //create access token
        $accessToken = $user->createToken('authToken')->accessToken;
        $user['accessToken'] = $accessToken;


        //return response
        return response(
            [
                'status' => 1,
                'message' => "You have loged in  successfully",
                'data' => $user,
            ]
        );
    }

    //for admin to view all users in the system;

    public function all_users()
    {

        //get all the users
        $users = User::get();

        //return response
        return response()->json(
            [
                "status" => 1,
                "message" => "All users",
                "data" => $users
            ]
        );
    }

    public function profile()
    {

        //get the user data
        $user_data = auth()->user();

        //return the response with the data
        return response()->json([
            "status" => 1,
            "message" => "User ",
            "User data" => $user_data
        ]);
    }





    public function logout(Request $request)
    {
        // get token value from the user
        $token = $request->user()->token();

        // revoke this token value
        $token->revoke();

        //return a response 
        return response()->json([
            "status" => 1,
            "message" => "User logged out successfully"
        ]);
    }
}
