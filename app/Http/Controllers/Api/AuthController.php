<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Models\Customer;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\Api\ApiResponses;
class AuthController extends Controller
{

    use ApiResponses ;
    public function login(LoginRequest $request)
    {
        // Validate Request
        $request->validated();

        // Make sure The User Have account
        if (!Auth::guard('customer')->attempt($request->only('phone', 'password'))) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        // Get Customer
        $customer = Customer::firstWhere('phone', $request->phone);

        // Return Response
        return $this->ok(
            'Authenticated',
            [
                'token' => $customer->createToken('API token for ' . $customer->phone)->plainTextToken,
            ]
        );
    }


    public function logout(Request $request): JsonResponse
    {
        $customer = $request->user('customer');

        if ($customer) {
            $customer->currentAccessToken()->delete();
        }
        
        return $this->ok('Logged out successfully');
    }

    public function Register(Request $request)
    {
        return "we are good";
    }
}
