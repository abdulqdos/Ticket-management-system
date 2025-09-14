<?php

namespace App\Filament\Resources\Events;

use App\Filament\Resources\Events\Pages\CreateEvent;
use App\Filament\Resources\Events\Pages\EditEvent;
use App\Filament\Resources\Events\Pages\ListEvents;
use App\Filament\Resources\Events\Pages\ViewEvent;
use App\Filament\Resources\Events\Schemas\EventForm;
use App\Filament\Resources\Events\Schemas\EventInfolist;
use App\Filament\Resources\Events\Tables\EventsTable;
use App\Models\Event;
use BackedEnum;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
//use Filament\Forms\Components\;
class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-s-calendar';
    protected static ?string $navigationLabel = 'Events';
    protected static ?string $recordTitleAttribute = 'Event';


    public static function form(Schema $schema): Schema
    {
        return EventForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return EventInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return EventsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
//            'ticketTypes' => RelationManagers\TicketTypesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListEvents::route('/'),
            'create' => CreateEvent::route('/create'),
            'view' => ViewEvent::route('/{record}'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function getNavigationLabel(): string
    {
        return __('Events');
    }


    public static function getTitle(): string
    {
        return __('Event list');
    }

    public static function getPluralModelLabel(): string
    {
        return __('Events');
    }


    public static function getModelLabel(): string
    {
        return __('Event');
    }

//    public function getTicketTypesCards($event)
//    {
//        return $event->ticketTypes->map(function ($ticket) {
//            return Infolist::make([
//                TextInput::make('name')
//                    ->label('Name')
//                    ->default($ticket->name)
//                    ->disabled(),
//
//                TextInput::make('price')
//                    ->label('Price')
//                    ->default($ticket->price . ' USD')
//                    ->disabled(),
//
//                TextInput::make('quantity')
//                    ->label('Quantity')
//                    ->default($ticket->quantity)
//                    ->disabled(),
//
//                Actions::make([
//                    Action::make('edit')
//                        ->label('Edit')
//                        ->color('primary')
//                        ->icon('heroicon-o-pencil')
//                        ->form([
//                            TextInput::make('name')->required()->default($ticket->name),
//                            TextInput::make('price')->numeric()->required()->default($ticket->price),
//                            TextInput::make('quantity')->required()->default($ticket->quantity),
//                        ])
//                        ->action(fn($data) => $ticket->update($data)),
//
//                    Action::make('delete')
//                        ->label('Delete')
//                        ->color('danger')
//                        ->icon('heroicon-o-trash')
//                        ->requiresConfirmation()
//                        ->action(fn() => $ticket->delete()),
//                ])->alignment('end'),
//            ])->columns(4); // 4 أعمدة لكل card
//        });
//    }

}
