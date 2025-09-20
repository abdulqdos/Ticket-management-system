<?php

namespace App\Http\Controllers\Api;

use App\actions\CustomerActions\CreateCustomerAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\Customer;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\Api\ApiResponses;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    use ApiResponses ;
    public function login(LoginRequest $request)
    {
        $request->validated();

        $customer = Customer::query();

        try {
            $customer = Customer::where('phone', $request->phone)->first();
        } catch (ModelNotFoundException $e) {
            return $this->error('Ticket Not Found' ,404);
        }

        if (! $customer || ! Hash::check($request->password, $customer->password)) {
            return $this->error('Invalid credentials', 401);
        }

        $token = $customer->createToken('API token for ' . $customer->phone, ['customer'])->plainTextToken;

        return $this->ok(
            'Authenticated',
            [
                'token' => $token,
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

    public function register(RegisterRequest $request)
    {
        $request->validated();

        // Create new Customer
        $customer = (new CreateCustomerAction(
            phone:       $request->phone,
            backupPhone: $request->backup_phone,
            firstName:   $request->first_name,
            lastName:    $request->last_name,
            email:       $request->email,
            password:    $request->password
        ))->execute();

        // Return Respone With Token
        return $this->ok(
            'Customer registered successfully',
            [
                'token' => $customer->createToken('API token for ' . $customer->phone)->plainTextToken,
            ]
        );
    }
}
