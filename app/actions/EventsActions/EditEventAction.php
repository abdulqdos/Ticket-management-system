<?php

namespace App\actions\EventsActions ;
use App\Models\Event;
use Illuminate\Support\Facades\DB;


Class EditEventAction
{

    public function __construct(
        public Event $event,
        public string $name,
        public string $description,
        public string $date,
        public int $total_tickets,
    ) {}

    public function execute(): Event
    {
        return DB::transaction(function () {
             $this->event->update([
                "name" => $this->name,
                "description" => $this->description,
                "date" => $this->date,
                "total_tickets" => $this->total_tickets,
            ]);

            return $this->event->fresh();
        });
    }
}
