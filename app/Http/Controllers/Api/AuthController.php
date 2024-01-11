<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function createToken(Request $request)
    {
      $this->validateRequest($request);
      if (!Auth::attempt($request->only('email', 'password')) && $request->user()->hasRole('admin')) {
        
        return $this->response('error','Unauthorized',401);
      }
      return $this->response('success','Authorized',200,["token"=>$request->user()->createToken($request->password)->plainTextToken]);

    }
    public function validateRequest(Request $request)
    {
      return $request->validate([
        'email' => 'required|email',
        'password' => 'required'
      ]);
    }
    
}