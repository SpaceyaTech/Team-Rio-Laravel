<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class JsonResponseController extends Controller
{
    /**
     * @description . The sendResponse method provides an easy way to force json response from the api
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($result, $message){
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, 200);
    }

    /**
     * @description the sendError method allows standard api error responses.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);

    }
}
