<?php


use App\Http\Resources\Api\V1\CustomerResource;
use App\Models\Customer;
use function Pest\Laravel\get;

beforeEach(function () {
   $this->customers = CustomerResource::collection(Customer::all())
        ->response()
        ->getData(true)['data'];
});

it('can access the route', function () {
   get(route('api.v1.customers.index'))
        ->assertStatus(200);
});

it('has all customers', function () {
    $this->getJson(route('api.v1.customers.index'))
        ->assertJson([
            'data' =>  $this->customers ,
        ]);
});
