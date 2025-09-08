<?php

namespace App\Filament\Resources\Events\Schemas;

use App\Models\Company;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Repeater;
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
                    ->label(__('Name'))
                    ->required(),
                TextInput::make('description')
                    ->label(__('Description'))
                    ->required(),
                Select::make('location')
                    ->label(__('Location'))
                    ->options([
                        "Tripoli",
                        "Bengazi",
                        "Misrata"
                    ])
                    ->required(),
                DateTimePicker::make('start_date')
                    ->label(__('Start Date'))
                    ->native(false)
                    ->required()
                    ->minDate(now())
                    ->displayFormat('Y-m-d h:i A'),
                DateTimePicker::make('end_date')
                    ->label(__('End Date'))
                    ->native(false)
                    ->required()
                    ->minDate(fn (callable $get) => $get('start_date'))
                    ->displayFormat('Y-m-d h:i A'),

                Select::make('company_id')
                    ->label(__('Company'))
                    ->options(Company::all()->pluck('name', 'id'))
                    ->required(),

                Repeater::make('ticketTypes')
                    ->label('Ticket Types')
                    ->schema([
                        TextInput::make('name')->label('Name')->required(),
                        TextInput::make('price')->label('Price')->required()->minValue(0),
                        TextInput::make('quantity')->label('Quantity')->required()->minValue(1),
                    ])
                    ->minItems(1)
                    ->createItemButtonLabel('Add Ticket Type')
                    ->columns(3), // 3 أعمدة: Name | Price | Quantity
            ]);
    }
}
