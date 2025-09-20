<?php

namespace Tests\Feature\Api\v1\TicketController ;

use App\actions\TicketActions\CreateTicketAction;
use App\actions\TicketActions\DeleteTicketAction;
use App\Models\Customer;
use App\Models\Event;
use App\Models\TicketType;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\deleteJson;

beforeEach(function () {
    $this->event = Event::factory()->create();
    TicketType::factory()->recycle($this->event)->create();
    $this->ticketType = TicketType::find(1);

    $this->customer = Customer::factory()->create();

    ((new CreateTicketAction(
        ticketType_id: $this->ticketType->id,
        customer_id: $this->customer->id,
        ticket_type: $this->ticketType
    ))->execute());
});

// Didn't Login
it('Unauthorized Test' ,  function () {
    deleteJson(route('api.v1.tickets.destroy', [
        'event' => $this->event,
        'ticket_type' => $this->ticketType
    ]))->assertUnauthorized();
});


// Can Destroy
it('can destroy a ticket' ,  function () {

    actingAs($this->customer);

    deleteJson(route('api.v1.tickets.destroy', [
        'event' => $this->event,
        'ticket_type' => $this->ticketType
    ]));

    $this->assertDatabaseCount('tickets' , 0);
});

// Increment Ticket Type Quantity
it('Increment Ticket' ,  function () {

    actingAs($this->customer);

    $oldQuantity = $this->ticketType->quantity ;

    deleteJson(route('api.v1.tickets.destroy', [
        'event' => $this->event,
        'ticket_type' => $this->ticketType
    ]));

    $this->ticketType->refresh();

    $this->assertEquals($oldQuantity + 1 , $this->ticketType->quantity);
});

// Ticket Type Dose Not Belongs To Event
it('Ticket Dose not belongs to event' , function () {

    actingAs($this->customer);

    $newTicketType = TicketType::factory()->create();

    $response = deleteJson(route('api.v1.tickets.destroy', [
        'event' => $this->event,
        'ticket_type' => $newTicketType
    ]));

    $response->assertJson([
        "errors" => [
            'message' => 'This ticket type does not belong to the selected event',
            'status' => 422
        ]
    ]);
});

// He Actually Have a Ticket
it('You Dont Have a Ticket' , function () {

    actingAs($this->customer);

    ((new DeleteTicketAction(
        ticket_type_id: $this->ticketType->id,
        customer_id: $this->customer->id,
        ticket_type: $this->ticketType
    ))->execute());

    $response = deleteJson(route('api.v1.tickets.destroy', [
        'event' => $this->event,
        'ticket_type' => $this->ticketType->id
    ]));

    $response->assertJson([
        "errors" => [
            'message' => 'You are do not booked this ticket to cancel',
            'status' => 422
        ]
    ]);
});

