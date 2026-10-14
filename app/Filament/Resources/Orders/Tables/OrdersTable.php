<?php

namespace App\Filament\Resources\Orders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('order_number')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('customer_name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('customer_phone')
                    ->searchable()
                    ->placeholder('—'),

                TextColumn::make('total_amount')
                    ->numeric(decimalPlaces: 0)
                    ->prefix('UGX ')
                    ->sortable(),

                TextColumn::make('payment_status')
                    ->badge()
                    ->sortable(),

                TextColumn::make('order_status')
                    ->badge()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
