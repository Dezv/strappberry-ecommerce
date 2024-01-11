<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function response($type,$message,$httpCodeResponse, $data=null){
        $response = [
            'status' => $type,
            'message' => $message,
        ]; 

        if(!is_null($data)){
            $response ['data']= $data;
        }

        return response()->json($response, $httpCodeResponse);
    }
}
