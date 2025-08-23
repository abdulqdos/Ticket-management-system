<?php

namespace App\Filament\Resources\Events\Pages;

use App\Filament\Resources\Events\EventResource;
use Filament\Resources\Pages\CreateRecord;
use App\actions\EventsActions\CreatEventAction ;
class CreateEvent extends CreateRecord
{
    protected static string $resource = EventResource::class;

    /**
     * @return string|null
     */
    public function getHeading(): string
    {
        return __('Create Event');
    }

    protected function handleRecordCreation(array $data): \App\Models\Event
    {
        return ((new CreatEventAction(
            name: $data['name'],
            description: $data['description'],
            date: $data['date'],
            total_tickets: $data['total_tickets'],
        ))->execute());
    }
}
