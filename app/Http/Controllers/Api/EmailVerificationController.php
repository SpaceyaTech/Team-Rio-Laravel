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

    public function verify($user_id, Request $request) {
        if (!$request->hasValidSignature()) {
            return response()->json([
                "status"=>0,
                "message" => "Invalid/Expired url provided."], 401);
        }

        $user = User::findOrFail($user_id);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }

        return response()->json([
            'status' => 1,
            'message' => 'Email verification was successfully',
        ]);

    }

    public function resend() {
        if (auth()->user()->hasVerifiedEmail()) {
            return response()->json([
                "status" =>0,
                "message" => "Email already verified."
            ]);
        }

        auth()->user()->sendEmailVerificationNotification();

        return response()->json([
            "status" =>1,
            "message" => "Email verification link sent on your email id"
        ]);
    }
}
