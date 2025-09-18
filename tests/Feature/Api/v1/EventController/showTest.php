<?php

use App\Http\Resources\Api\V1\EventResource;
use App\Models\Event;
use function Pest\Laravel\get;

beforeEach(function () {
    $this->data = Event::factory()->create();
    $this->event = EventResource::make($this->data)
        ->response()
        ->getData(true)['data'];
});

it('can access the route', function () {
    get(route('api.v1.events.show', $this->event['id']  ))
        ->assertStatus(200);
});

it('has event', function () {
    get(route('api.v1.events.show' , $this->event['id'] ))
        ->assertJson([
            'data' =>  $this->event ,
        ]);
});
