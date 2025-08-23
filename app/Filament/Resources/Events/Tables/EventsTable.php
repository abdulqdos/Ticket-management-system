<?php

namespace App\Filament\Resources\Events\Tables;

use App\actions\EventsActions\EditEventAction;
use App\Models\Event;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make("name")
                    ->label(__('Name'))
                    ->searchable(),
                TextColumn::make('description')
                    ->label(__('Description'))
                    ->searchable(),
                TextColumn::make('date')
                    ->label(__('Date'))
                    ->date('d-m-Y')
                    ->sortable(),
                TextColumn::make('total_tickets')
                    ->label(__('Total Tickets'))
                    ->numeric()
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->using(fn ($record , array $data): Event => ((new EditEventAction(
                        event: $record,
                        name: $data['name'],
                        description: $data['description'],
                        date: $data['date'],
                        total_tickets: $data['total_tickets'],
                    ))->execute())),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
