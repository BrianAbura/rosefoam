<?php

namespace App\Filament\Resources\Orders\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Order Information')
                    ->description('Customer, delivery and payment details for this order.')
                    ->columns(2)
                    ->schema([
                        TextInput::make('order_number')
                            ->disabled(),

                        Select::make('order_status')
                            ->options([
                                'pending' => 'Pending',
                                'confirmed' => 'Confirmed',
                                'processing' => 'Processing',
                                'dispatched' => 'Dispatched',
                                'delivered' => 'Delivered',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required(),

                        TextInput::make('customer_name')
                            ->disabled(),

                        TextInput::make('customer_phone')
                            ->disabled(),

                        TextInput::make('customer_email')
                            ->disabled(),

                        Select::make('payment_status')
                            ->options([
                                'unpaid' => 'Unpaid',
                                'pending_verification' => 'Pending Verification',
                                'paid' => 'Paid',
                                'failed' => 'Failed',
                                'refunded' => 'Refunded',
                            ])
                            ->required(),

                        TextInput::make('delivery_address')
                            ->disabled()
                            ->columnSpanFull(),

                        TextInput::make('delivery_district')
                            ->disabled(),

                        TextInput::make('payment_method')
                            ->disabled(),

                        TextInput::make('payment_reference')
                            ->label('Payment Reference'),

                        Textarea::make('customer_notes')
                            ->label('Customer notes')
                            ->disabled()
                            ->rows(3)
                            ->placeholder('—')
                            ->columnSpanFull(),
                    ]),

                Section::make('Admin')
                    ->description('Internal notes and timestamps.')
                    ->schema([
                        Textarea::make('admin_notes')
                            ->rows(4)
                            ->columnSpanFull(),

                        DateTimePicker::make('confirmed_at'),

                        DateTimePicker::make('delivered_at'),
                    ]),
            ]);
    }
}
