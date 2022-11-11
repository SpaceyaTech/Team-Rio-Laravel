<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\JsonResponseController as ResponseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RegisterController extends ResponseController
{
    public function Register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
            'phonenumber' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $password = bcrypt($input['password']);

        $fname = $input['firstname'];
        $lname = $input['lastname'];
        $email = $input['email'];
        $phone = $input['phonenumber'];
        $gender = $input['gender'];
        $status = $input['status'];
        $about = $input['about'];
        $image = "c:/images/photo.png";

        // $user = User::where('phone_no', '=', $phone)->first(); //for some reason laravel thinks it wise to add a deleted_at field to the query builder. This keeps failing
        $user = DB::table('users')
            ->select('phone_no')
            ->where('phone_no', '=', $phone)
            ->first();
        if ($user != null) {
            return $this->sendError('A User with the Phone Number '.$phone.' Already Exists.');
        }

        $user = User::create([
            'first_name' => $fname,
            'second_name' => $lname,
            'username' => $fname . $lname,
            'password' => $password,
            'name' => $fname . " " . $lname,
            'email' => $email,
            'phone_no' => $phone,
            'image' => $image,
            'status' => $status,
            'about' => $about,
        ]);
        $success['token'] = $user->createToken('Spaceyatech')->accessToken;
        return $this->sendResponse($success, $fname . " " . $lname . ' registered successfully.');
    }
}
