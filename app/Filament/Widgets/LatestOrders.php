<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;

class LatestOrders extends TableWidget
{
    protected static ?string $heading = 'Latest orders';

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Order::query()->latest()->limit(5))
            ->columns([
                TextColumn::make('order_number')
                    ->label('Order'),

                TextColumn::make('customer_name')
                    ->label('Customer'),

                TextColumn::make('total_amount')
                    ->label('Total')
                    ->prefix('UGX ')
                    ->numeric(decimalPlaces: 0),

                TextColumn::make('order_status')
                    ->badge()
                    ->label('Status'),

                TextColumn::make('created_at')
                    ->label('Placed')
                    ->dateTime(),
            ])
            ->paginated(false);
    }
}
