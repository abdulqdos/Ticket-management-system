<?php



use App\Http\Resources\Api\V1\EventResource;
use App\Models\Event;
use function Pest\Laravel\get;

beforeEach(function () {
    $this->events = EventResource::collection(Event::all())
        ->response()
        ->getData(true)['data'];
});

it('can access the route', function () {
    get(route('api.v1.events.index'))
        ->assertStatus(200);
});

it('has all events', function () {
    $this->getJson(route('api.v1.events.index'))
        ->assertJson([
            'data' =>  $this->events ,
        ]);
});
