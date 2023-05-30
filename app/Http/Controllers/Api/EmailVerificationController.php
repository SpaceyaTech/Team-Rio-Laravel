<?php

namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{

    public function verify($user_id, Request $request)
    {
        //if the token/signature is not valid
        if (!$request->hasValidSignature()) {
            //return response
            return response()->json([
                "status" => 0,
                "message" => "Invalid/Expired url provided."
            ], 401);
        }
        //else find the user with the id

        $user = User::findOrFail($user_id);
        //if user is not verified the change the email to verified
        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }
        //then return  the response 
        return response()->json([
            'status' => 1,
            'message' => 'Email verification was successfully',
        ]);
    }

    public function resend()
    {
        //if user has verified email
        if (auth()->user()->hasVerifiedEmail()) {
            //return response
            return response()->json([
                "status" => 0,
                "message" => "Email already verified."
            ]);
        }
        //else send the verification link to the user

        auth()->user()->sendEmailVerificationNotification();
        //return response
        return response()->json([
            "status" => 1,
            "message" => "Email verification link sent on your email id"
        ]);
    }
}
