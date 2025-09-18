<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type'  => 'ticketType',
            'attributes' => [
                'name' => $this->name,
                'price' => $this->price,
                'quantity' => $this->quantity,
                'event_id' => $this->event->id
            ],
        ];
    }
}
