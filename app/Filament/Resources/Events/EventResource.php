<?php

namespace App\Filament\Resources\Events;

use App\Enum\EventState;
use App\Filament\Resources\Events\Pages\CreateEvent;
use App\Filament\Resources\Events\Pages\EditEvent;
use App\Filament\Resources\Events\Pages\ListEvents;
use App\Filament\Resources\Events\Schemas\EventForm;
use App\Filament\Resources\Events\Tables\EventsTable;
use App\Models\Event;
use BackedEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
//use Livewire\Form;
//use Filament\Forms;
//use Filament\Forms\Form;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-s-calendar';

    protected static ?string $recordTitleAttribute = 'Event';

    public static function form(Schema $schema): Schema
    {
        return $schema->inlineLabel()->components(
            [
                TextInput::make('name')
                    ->required()
                    ->minLength(2)
                    ->maxLength(255)
                    ->placeholder('Event name'),
                TextInput::make('description')
                    ->label('Description')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Event description'),
                DatePicker::make('date')
                    ->native(false)
                    ->displayFormat('d/m/Y'),
                Select::make('state')
                    ->options(EventState::class),
                TextInput::make('total_tickets')
                    ->label('Total Tickets')
                    ->required()
                    ->numeric()
                    ->minValue(0)
            ]
        );
    }

    public static function table(Table $table): Table
    {
        return EventsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEvents::route('/'),
            'create' => CreateEvent::route('/create'),
//            'edit' => EditEvent::route('/{record}/edit'),
        ];
    }
}
