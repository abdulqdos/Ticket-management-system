<?php


use App\Http\Resources\Api\V1\CustomerResource;
use App\Models\Customer;
use function Pest\Laravel\get;

beforeEach(function () {

    $this->data = Customer::factory()->create();
    $this->customer = CustomerResource::make($this->data)
        ->response()
        ->getData(true)['data'];
});

it('can access the route', function () {
    get(route('api.v1.customers.show', $this->customer['id']))
        ->assertStatus(200);
});

it('has all customers', function () {
    get(route('api.v1.customers.show', $this->customer['id']))
        ->assertJson([
            'data' =>  $this->customer ,
        ]);
});
