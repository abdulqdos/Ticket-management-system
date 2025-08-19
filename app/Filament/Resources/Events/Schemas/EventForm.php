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
                    ->required(),
                TextInput::make('description')
                    ->required(),
                TextInput::make('state')
                    ->required(),
                DateTimePicker::make('date')
                    ->required(),
                TextInput::make('total_tickets')
                    ->required()
                    ->numeric(),
            ]);
    }
}
