<?php

namespace App\Filament\Resources\Events\RelationManagers;

use App\Filament\Resources\Events\EventResource;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Components\Form;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Forms;
use Filament\Schemas\Schema;
use Filament\Tables;


class TicketTypesRelationManager extends RelationManager
{
    protected static string $relationship = 'ticketTypes';

//    protected static ?string $relatedResource = EventResource::class;


    public function isReadOnly(): bool
    {
        return false;
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextInput::make('name')
                    ->required(),

                TextInput::make('price')
                    ->numeric()
                    ->required(),

                TextInput::make('quantity')
                    ->required(),
            ]);
    }
    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('ticketTypes')
            ->columns([
                TextColumn::make('name')->label(__('name')),
                TextColumn::make('price')->label(__('price')),
                TextColumn::make('quantity')->label(__('quantity')),
            ])
            ->headerActions([
                CreateAction::make(),
            ])->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
