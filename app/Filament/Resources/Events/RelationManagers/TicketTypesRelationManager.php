<?php

namespace App\Filament\Resources\Events\RelationManagers;

use App\Filament\Resources\Events\EventResource;
use Filament\Actions\CreateAction;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TicketTypesRelationManager extends RelationManager
{
    protected static string $relationship = 'ticketTypes';

    protected static ?string $relatedResource = EventResource::class;

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('ticketTypes')
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('price'),
                TextColumn::make('quantity'),
            ])
            ->headerActions([
//                CreateAction::make(),
            ]);
    }
}
