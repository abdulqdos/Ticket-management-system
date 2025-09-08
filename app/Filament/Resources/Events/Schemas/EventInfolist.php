<?php

namespace App\Filament\Resources\Events\Schemas;

use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\Repeater;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
class EventInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(3)
            ->components([
                Section::make(__('Main Information'))
                    ->columnSpan(2)
                    ->schema([
                        ImageEntry::make('avatar')
                            ->circular()
                            ->defaultImageUrl(
                                fn ($record) => 'https://ui-avatars.com/api/?background=8A2BE2&color=fff&name=' . urlencode($record->name)
                            ),
                        Group::make()
                            ->columnSpan(2)
                            ->columns(2)
                            ->schema([
                                TextEntry::make('name')
                                    ->label(__('Name'))
                                    ->weight('bold')
                                    ->size('lg'),

                                TextEntry::make('company.name')
                                    ->label(__('Company'))
                                    ->icon('heroicon-o-building-office'),

                                TextEntry::make('description')
                                    ->label(__('Description'))
                                    ->columnSpanFull()
                                    ->placeholder('-'),

                                TextEntry::make('location')
                                    ->label(__('Location'))
                                    ->icon('heroicon-o-map-pin'),

                                TextEntry::make('start_date')
                                    ->label(__('Start Date'))
                                    ->dateTime('d M Y - h:i A')
                                    ->icon('heroicon-o-calendar'),

                                TextEntry::make('end_date')
                                    ->label(__('End Date'))
                                    ->dateTime('d M Y - h:i A')
                                    ->icon('heroicon-o-calendar'),
                            ]),
                    ]),

                Section::make(__('Ticket Types'))
                    ->columnSpan(1)
                    ->schema([
                        RepeatableEntry::make('ticketTypes')
                            ->schema([
                                TextEntry::make('name')
                                    ->label('Name')
                                    ->weight('bold'),

                                TextEntry::make('price')
                                    ->label('Price')
                                    ->suffix(' USD'),

                                TextEntry::make('quantity')
                                    ->label('Quantity'),

                                Actions::make([
                                    Action::make('edit')
                                        ->label('Edit')
                                        ->icon('heroicon-o-pencil')
                                        ->color('primary'),

                                    Action::make('delete')
                                        ->label('Delete')
                                        ->icon('heroicon-o-trash')
                                        ->color('danger')
                                        ->requiresConfirmation()
                                        ->action(fn ($record, $state) => $record->ticketTypes()->where('id', $state['id'])->delete()),
                                ])->columnSpanFull(), 
                            ])
                            ->columns(3),
            ])]);
    }
}
