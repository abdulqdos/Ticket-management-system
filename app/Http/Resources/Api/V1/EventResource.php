<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
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
            'type'  => 'event',
            'attributes' => [
                "name" => $this->name,
                "description" => $this->description,
                "start_date" => $this->start_date,
                "end_date" => $this->end_date,
                "location" => $this->location,
                "company" => $this->company,

            ],
            'relationships' => [
                'ticket_types' => [
                    'data' => TicketTypeResource::collection($this->ticketTypes),
                ],

                'city' => [
                    'data' => CityResource::make($this->city),
                ],

                'company' => [
                    'data' => CompanyResource::make($this->company),
                ]
            ]
        ];
    }
}
