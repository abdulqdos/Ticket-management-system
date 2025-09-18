<?php

namespace App\Http\Controllers\Api\V1;

use App\actions\TicketActions\CreateTicketAction;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\TicketType;
use App\Traits\Api\ApiResponses;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookingController extends Controller
{
    use ApiResponses ;
    // Booking Ticket
    public  function store(Event $event ,TicketType $ticketType )
    {
        // if the customer dose not booking this ticket before
        $customer = auth()->user();

        $alreadyBooked = $customer->tickets->contains(function ($ticket) use ($ticketType) {
            return $ticket->ticket_type_id === $ticketType->id;
        });

        if($alreadyBooked) {
            return $this->error([
                'message' => 'You are  already booked this ticket',
            ] , 422);
        }


        // if ticket belongs to event
        if($event->id !== $ticketType->event_id)
        {
            return $this->error([
                'message' => 'This ticket type does not belong to the selected event.',
            ] , 400);
        }

        // check if ticket still available (count - 1)
        if ($ticketType->quantity <= 0) {
            return $this->error([
                'message' => 'No tickets available for this type.'
            ] , 400);
        }

        // book a ticket with customer (pivot table)
        $ticket = (new CreateTicketAction(
            ticketType_id: $ticketType->id,
            customer_id: $customer->id
        ))->execute();


        return response()->ok([
            "message" => "Your Booked Has Create Check your profile",
            'data' => $ticket
        ], 200 );
    }

    // Cancel Booking
    public static function destroy()
    {

    }
}
