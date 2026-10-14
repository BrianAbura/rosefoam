<?php

namespace App\Filament\Resources\Orders\RelationManagers;

use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrderItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    protected static ?string $recordTitleAttribute = 'product_name';

    protected static ?string $title = 'Order items';

    protected static ?string $pluralLabel = 'Order items';

    public function isReadOnly(): bool
    {
        return true;
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product_name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('product_sku')
                    ->placeholder('—'),

                TextColumn::make('unit_price')
                    ->numeric(decimalPlaces: 0)
                    ->prefix('UGX ')
                    ->sortable(),

                TextColumn::make('quantity')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('line_total')
                    ->numeric(decimalPlaces: 0)
                    ->prefix('UGX ')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                //
            ])
            ->toolbarActions([
                //
            ]);
    }
}
