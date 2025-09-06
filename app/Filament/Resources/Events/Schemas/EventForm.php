<?php

namespace App\Filament\Resources\Events\Schemas;

use App\Models\Company;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
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
                Select::make('location')
                    ->options([
                        "Tripoli",
                        "Bengazi",
                        "Misrata"
                    ])
                    ->required(),
                DateTimePicker::make('start_date')
                    ->native(false)
                    ->required()
                    ->minDate(now())
                    ->displayFormat('Y-m-d h:i A'),
                DateTimePicker::make('end_date')
                    ->native(false)
                    ->required()
                    ->minDate(fn (callable $get) => $get('start_date'))
                    ->displayFormat('Y-m-d h:i A'),

                Select::make('company_id')
                    ->label(__('company'))
                    ->options(Company::all()->pluck('name', 'id'))
                    ->required(),
            ]);
    }
}
