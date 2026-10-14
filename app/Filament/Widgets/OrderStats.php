<?php

namespace App\Filament\Widgets;

use App\Models\Order;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class OrderStats extends StatsOverviewWidget
{
    protected ?string $heading = 'Orders at a glance';

    protected function getStats(): array
    {
        $pending = Order::where('order_status', 'pending')->count();
        $confirmed = Order::where('order_status', 'confirmed')->count();
        $total = Order::count();
        $revenue = Order::where('order_status', '!=', 'cancelled')->sum('total_amount');

        return [
            Stat::make('Pending orders', $pending)
                ->description('Awaiting confirmation')
                ->color('warning'),

            Stat::make('Confirmed orders', $confirmed)
                ->description('Ready to process')
                ->color('primary'),

            Stat::make('Total orders', $total)
                ->description('All time')
                ->color('gray'),

            Stat::make('Revenue', 'UGX ' . number_format($revenue))
                ->description('Excluding cancelled')
                ->color('success'),
        ];
    }
}
