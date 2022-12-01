<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Account as ModelsAccount;
use Illuminate\Http\Request;
use Tests\Feature\Account;

class AccountController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all the accounts and save it a variable $account

        $account = ModelsAccount::get();

        //return response and the accounts data included
        return response()->json(
            [
                "status" => 1,
                "message" => "All Accounts",
                "data" => $account
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
                "user_id" => "required",
                "account_name" => "required",
                // "image" => "required",
                // "bio_data" => "required",

            ]
        );

        //create account with data from the user
        $account = new ModelsAccount();

        $account->user_id = auth()->user()->id;
        $account->account_name = $request->account_name;
        $account->image = $request->image;
        $account->bio_data = $request->bio_data;

        //save the account data/account
        $account->save();


        //send response
        return response()->json(
            [
                "status" => 1,
                "message" => "Account created successfully",
                "data" => $account

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


        //find the account if the account exists then return details in json format
        if (ModelsAccount::where("id", $id)->exists()) {
            //account details will be details of account matching the id
            $account_details = ModelsAccount::where("id", $id)->first();
            //return response
            return response()->json(
                [
                    "status" => 1,
                    "message" => "Account found",
                    "details" => $account_details
                ]
            );
        } else {
            //else the account with the id was not found
            return response()->json(
                [
                    "status" => 0,
                    "message" => "Account not found",

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

        //check if account with the id exists

        if (ModelsAccount::where("id", $id)->exists()) {


            //find the account with the specified id
            $account = ModelsAccount::find($id);


            //update if updated value if empty(no value to be updated) retain the value that was in the database
            $account->user_id = !empty($request->user_id) ? $request->user_id : $account->user_id;
            $account->account_name = !empty($request->account_name) ? $request->account_name : $account->account_name;
            $account->image = !empty($request->image) ? $request->image : $account->image;
            $account->bio_data = !empty($request->bio_data) ? $request->bio_data : $account->bio_data;

            //save the updates
            $account->save();


            //if update was successful return response
            return response()->json([
                "status" => 1,
                "message" => "Account updated successfully",
                "data" => $account

            ]);
        } else {

            //the account with the id specified not found
            return response()->json([
                "status" => 0,
                "message" => "Account not found",

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
        //check if account with the id exists

        if (ModelsAccount::where("id", $id)->exists()) {


            //find the account with the specified id
            $account = ModelsAccount::find($id);


            //deleting a Account
            $account->delete();


            //return response
            return response()->json([
                "status" => 1,
                "message" => "Account deleted successfully",

            ]);
        } else {

            //the Account with the id specified not found
            return response()->json([
                "status" => 0,
                "message" => "Account not found",

            ], 404);
        }
    }
}
