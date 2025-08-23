<?php

namespace App\actions\EventsActions ;
use App\Models\Event ;
use Illuminate\Support\Facades\DB;

class CreatEventAction
{
    protected Event $event;

    public function __construct(
        public string $name,
        public string $description,
        public string $date,
        public int $total_tickets,
    ) {}

    public function execute(): Event
    {
        return DB::transaction(function () {
            return Event::create([
                "name" => $this->name,
                "description" => $this->description,
                "date" => $this->date,
                "total_tickets" => $this->total_tickets,
            ]);
        });
    }

}
