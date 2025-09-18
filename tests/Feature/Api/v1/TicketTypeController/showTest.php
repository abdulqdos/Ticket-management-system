<?php

use App\Http\Resources\Api\V1\TicketTypeResource;
use App\Models\TicketType;
use function Pest\Laravel\get;

beforeEach(function () {
    $this->data = TicketType::factory()->create();
    $this->ticketType = TicketTypeResource::make($this->data)
        ->response()
        ->getData(true)['data'];
});

it('can access the route', function () {
    get(route('api.v1.ticket-types.show', $this->ticketType['id']  ))
        ->assertStatus(200);
});

it('has ticket type', function () {
    get(route('api.v1.ticket-types.show' , $this->ticketType['id'] ))
        ->assertJson([
            'data' =>  $this->ticketType ,
        ]);
});
