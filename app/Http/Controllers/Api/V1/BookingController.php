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
    public  function store($event_id ,$ticketType_id )
    {
        // if the customer dose not booking this ticket before
        $customer = auth()->user();

        // Check if Event && Ticket is Here
        $event =  Event::FindOrFailWithError($event_id);
        $ticketType = TicketType::FindOrFailWithError($ticketType_id);


        // if ticket belongs to event
         if(!$event->getTicketType($ticketType)) {
             return $this->error([
                 'message' => 'This ticket type does not belong to the selected event.',
                 'status' => 422
             ], 422);
         }
         
        if($customer->alreadyBooked($ticketType)) {
            return $this->error([
                'message' => 'You are  already booked this ticket',
                'status' => 422
            ] , 422);
        }

        // check if ticket still available (count - 1)
        if (!$ticketType->isAvaliable()) {
            return $this->error([
                'message' => 'No tickets available for this type.',
                'status' => 422
            ] , 422);
        } else {
            $ticketType->decrement('quantity');
        }

     // book a ticket with customer (pivot table)
        $ticket = (new CreateTicketAction(
            ticketType_id: $ticketType->id,
            customer_id: $customer->id
        ))->execute();

        return $this->ok([
            "message" => "Your Booked Has Create Check your profile",
            'data' => $ticket,
            'status' => 201
        ], 201 );
    }

    // Cancel Booking
    public static function destroy()
    {

    }
}
