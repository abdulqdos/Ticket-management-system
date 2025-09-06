<?php

namespace App\actions\EventsActions ;
use App\Models\Company;
use App\Models\Event ;
use Illuminate\Support\Facades\DB;

class CreatEventAction
{
    protected Event $event;

    public function __construct(
        public string $name,
        public string $description,
        public float $location,
        public string $start_date,
        public string $end_date,
        public int $company,
    ) {}

    public function execute(): Event
    {
        return DB::transaction(function () {
            return Event::create([
                "name" => $this->name,
                "description" => $this->description,
                "start_date" => $this->start_date,
                "end_date" => $this->end_date,
                "location" => $this->location,
                "company_id" => $this->company,
            ]);
        });
    }

}
