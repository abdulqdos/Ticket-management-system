<?php


use App\actions\TicketActions\CreateTicketAction;
use App\Models\Customer;
use App\Models\Event;
use App\Models\TicketType;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;
use function Pest\Laravel\postJson;

beforeEach(function () {
    $this->event = Event::factory()->create();
    TicketType::factory()->recycle($this->event)->create();
    $this->ticketType = TicketType::find(1);

    $this->customer = Customer::factory()->create();
});

// Unauthenticated => 401
it('Unauthenticated Test', function () {
    postJson(route('api.v1.tickets.store', [
        'event' => $this->event,
        'ticket_type' =>  $this->ticketType
    ]))->assertUnauthorized();
});


it('can store a ticket', function () {

    actingAs($this->customer);

    postJson(route('api.v1.tickets.store', [
        'event' => $this->event,
        'ticket_type' =>  $this->ticketType
    ]));

    $this->assertDatabaseCount('tickets', 1);
});


// Ticket Count Decrement
it('ticket type quantity decrement', function () {

    actingAs($this->customer);

    $oldQuantity = $this->ticketType->quantity ;
    postJson(route('api.v1.tickets.store', [
        'event' => $this->event,
        'ticket_type' =>  $this->ticketType
    ]));

    $this->ticketType->refresh();

    $this->assertEquals($oldQuantity - 1, $this->ticketType->quantity );
});



// Ticket Dont Belong To Event
it('if ticket dont belongs to event gimme error', function () {
    actingAs($this->customer);

    $newTicketType = TicketType::factory()->create();

    $response = postJson(route('api.v1.tickets.store', [
        'event' => $this->event,
        'ticket_type' =>  $newTicketType
    ]));

    $response->assertJson([
        "errors" => [
            "message" =>  "This ticket does not belong to the selected event",
            "status" =>  422
        ]
    ]);
});

// There is no ticket to Booking
it('no ticket available', function () {
    actingAs($this->customer);

    $this->ticketType->quantity = 0 ;
    $this->ticketType->save();

    $response = postJson(route('api.v1.tickets.store', [
        'event' => $this->event,
        'ticket_type' =>  $this->ticketType
    ]));

    $response->assertJson([
        "errors" => [
            "message" =>  "Sorry , No tickets available .",
            "status" =>  422
        ]
    ]);
});


// There is no ticket to Booking
it('is ticket already booked', function () {
    actingAs($this->customer);

    ((new CreateTicketAction(
        ticketType_id: $this->ticketType->id,
        customer_id: $this->customer->id,
        ticket_type: $this->ticketType
    ))->execute());

    $response = postJson(route('api.v1.tickets.store', [
        'event' => $this->event,
        'ticket_type' =>  $this->ticketType
    ]));

    $response->assertJson([
        "errors" => [
            "message" =>  "You are  already booked this ticket",
            "status" =>  422
        ]
    ]);
});
