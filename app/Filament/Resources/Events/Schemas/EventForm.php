<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class EventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label(__('Name'))
                    ->required(),
                TextInput::make('description')
                    ->label(__('Description'))
                    ->required(),
                TextInput::make('state')
                    ->label(__('State'))
                    ->required(),
                DateTimePicker::make('date')
                    ->label(__('Date'))
                    ->required(),
                TextInput::make('total_tickets')
                    ->label(__('Total Tickets'))
                    ->required()
                    ->numeric(),
            ]);
    }
}
