<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Role as ModelsRole;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $roles = ModelsRole::get();
        return response()->json(
            [
                "status" => 1,
                "message" => "All Roles",
                "data" => $roles
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

        //validation
        $request->validate(
            [
                "role_name" => "required",

            ]
        );

        //create role
        $role = new ModelsRole();

        $role->role_name = $request->role_name;

        //save
        $role->save();


        //send response
        return response()->json(
            [
                "status" => 1,
                "message" => "Role created successfully",
                "data" => $role

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


        //find the role if the if exists then return details in json format
        if (ModelsRole::where("id", $id)->exists()) {
            $role_details = ModelsRole::where("id", $id)->first();

            return response()->json(
                [
                    "status" => 1,
                    "message" => "Role found",
                    "details" => $role_details
                ]
            );
        } else {
            return response()->json(
                [
                    "status" => 0,
                    "message" => "Role not found",

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



        if (ModelsRole::where("id", $id)->exists()) {


            //find the role with the specified id
            $role = ModelsRole::find($id);


            //update if updated value is empty(no value to be updated) retain the value in the database
            $role->role_name = !empty($request->role_name) ? $request->role_name : $role->role_name;


            //save the updates
            $role->save();


            //if update was successful return response
            return response()->json([
                "status" => 1,
                "message" => "Role updated successfully",
                "data" => $role

            ]);
        } else {

            //the role with the id specified not found
            return response()->json([
                "status" => 0,
                "message" => "Role not found",

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


        if (ModelsRole::where("id", $id)->exists()) {


            //find the role with the specified id
            $account = ModelsRole::find($id);


            //deleting a Account
            $account->delete();


            //return response
            return response()->json([
                "status" => 1,
                "message" => "Role deleted successfully",

            ]);
        } else {

            //the Role with the id specified not found
            return response()->json([
                "status" => 0,
                "message" => "Role not found",

            ], 404);
        }
    }
}
