<?php

namespace App\Filament\Resources\Events\Schemas;

use App\Models\TicketTypes;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Actions;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
class EventInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->columns(5)
            ->components([
                Section::make(__('Main Information'))
                    ->columnSpan(3)
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
                    ->columnSpan(2)
                    ->schema([
                        RepeatableEntry::make('ticketTypes')
                            ->label('Ticket Types')
                            ->schema([
                                Grid::make(4)
                                    ->schema([
                                        TextEntry::make('name')
                                            ->label('Name')
                                            ->weight('bold')
                                            ->default(fn ($record) => $record->name), // pre-fill

                                        TextEntry::make('price')
                                            ->label('Price')
                                            ->suffix(' USD')
                                            ->default(fn ($record) => $record->price),

                                        TextEntry::make('quantity')
                                            ->label('Quantity')
                                            ->default(fn ($record) => $record->quantity),

                                        Actions::make([
                                            Action::make('editTicketType')
                                                ->label(__('Edit'))
                                                ->icon('heroicon-o-pencil')
                                                ->color('primary')
                                                ->record(fn ($row) => TicketTypes::find($row->id))
                                                ->form([
                                                    Grid::make(3)
                                                        ->schema([
                                                            TextInput::make('name')
                                                                ->required()
                                                                ->default(fn ($record) => $record->name),

                                                            TextInput::make('price')
                                                                ->numeric()
                                                                ->required()
                                                                ->default(fn ($record) => $record->price),

                                                            TextInput::make('quantity')
                                                                ->required()
                                                                ->default(fn ($record) => $record->quantity),
                                                        ]),
                                                ])
                                                ->action(fn ($ticket, $data) => $ticket->update($data)),

                                            Action::make('deleteTicketType')
                                                ->label(__('Delete'))
                                                ->icon('heroicon-o-trash')
                                                ->color('danger')
                                                ->requiresConfirmation()
                                                ->action(fn ($record, $data) => $record->ticketTypes()->where('id', $data['id'])->delete()),
                                        ])->alignment('end'),
                                ]),
                            ])
                            ->columnSpanFull(),
                    ])
                    ->columns(3)
                    ->headerActions([
                        Action::make('createTicketType')
                            ->label(__('Create'))
                            ->icon('heroicon-o-plus')
                            ->color('success')
                            ->extraAttributes([
                                'class' => 'text-white',
                            ])->form([
                                Grid::make(3)
                                    ->schema([
                                        TextInput::make('name')->required(),
                                        TextInput::make('price')->numeric()->required(),
                                        TextInput::make('quantity')->numeric()->required(),
                                    ])

                            ])
                            ->action(fn ($record, $data) => $record->ticketTypes()->create($data)),
                    ]),
        ]);
    }
}
