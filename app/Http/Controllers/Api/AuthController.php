<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {
        // Validate Request
        $request->validated();

        // Make sure The User Have account
        if (!Auth::guard('customer')->attempt($request->only('phone', 'password'))) {
            return $this->error('Invalid credentials', 401);
        }

        // Return Response
        return  response()->json([
          "message" =>  $request->all(),
        ]);
    }


    public function logout(Request $request)
    {
        return "we are good";
    }

    public function Register(Request $request)
    {
        return "we are good";
    }
}
