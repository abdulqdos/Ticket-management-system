<?php

namespace App\actions\EventActions ;

use App\Models\Event;
use Illuminate\Support\Facades\DB;

class CreateEventTicketTypeAction
{
    public function __construct(
        public string $name,
        public float $price,
        public int $quantity,
        public Event $event,
    ) {}

    public function execute()
    {
        return DB::transaction(function () {
            $this->event->ticketTypes()->create(
                [
                    'name' => $this->name,
                    'price' => $this->price,
                    'quantity' => $this->quantity,
                    'event_id' => $this->event->id
                ]
            );
        });
    }
}
