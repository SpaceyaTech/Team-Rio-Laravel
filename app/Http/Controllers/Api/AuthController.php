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
        //validate data
        $validatedData = $request->validate([
            'username' => 'required|max:55|unique:users,username',
            'email' => 'email|required|unique:users',
            'phone_no' => 'required|max:55|unique:users,phone_no',
            'password' => 'required|confirmed'
        ]);

        //hash password
        $validatedData['password'] = bcrypt($request->password);
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
        //validate date
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

        $users = User::get();

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
        $user_data = auth()->user();


        return response()->json([
            "status" => 1,
            "message" => "User ",
            "User data" => $user_data
        ]);
    }





    public function logout(Request $request)
    {
        // get token value
        $token = $request->user()->token();

        // revoke this token value
        $token->revoke();

        return response()->json([
            "status" => 1,
            "message" => "User logged out successfully"
        ]);
    }
}
