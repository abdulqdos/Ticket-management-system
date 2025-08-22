<?php

namespace App\Filament\Resources\Events\Pages;

use App\Filament\Resources\Events\EventResource;
use Filament\Resources\Pages\CreateRecord;
use App\Actions\EventsActions\CreatEventAction ;
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


    public function getSubmitAction(array $eventData,): CreatEventAction
    {
        return new CreatEventAction(
            name:  $eventData['name'],
            description: $eventData['description'],
            date:      $eventData['date'],
            total_tickets:      $eventData['total_tickets'],
        );
    }
}
