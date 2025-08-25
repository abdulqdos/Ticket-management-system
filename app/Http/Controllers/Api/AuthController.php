<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    public function login(Request $request)
    {
//        dd("yup");
        return  response()->json([
          "message" =>  "we are good"
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
