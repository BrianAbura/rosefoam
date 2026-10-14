<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug', \Illuminate\Support\Str::slug($state));
                    }),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                TextInput::make('sku')
                    ->label('Product SKU')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                Textarea::make('short_description')
                    ->rows(3)
                    ->maxLength(500)
                    ->columnSpanFull(),

                RichEditor::make('description')
                    ->columnSpanFull(),

                TextInput::make('price')
                    ->label('Selling Price (UGX)')
                    ->numeric()
                    ->prefix('UGX')
                    ->minValue(0)
                    ->required(),

                TextInput::make('compare_at_price')
                    ->label('Previous Price (UGX)')
                    ->numeric()
                    ->prefix('UGX')
                    ->minValue(0),

                FileUpload::make('image')
                    ->label('Main Product Image')
                    ->image()
                    ->disk('public')
                    ->directory('products')
                    ->visibility('public')
                    ->imageEditor(),

                TextInput::make('stock_quantity')
                    ->numeric()
                    ->integer()
                    ->minValue(0)
                    ->default(0)
                    ->required(),

                Toggle::make('manage_stock')
                    ->label('Enforce Stock Quantity')
                    ->default(false),

                Toggle::make('is_active')
                    ->label('Published')
                    ->default(true),

                Toggle::make('is_featured')
                    ->label('Featured on Homepage')
                    ->default(false),

                TextInput::make('sort_order')
                    ->numeric()
                    ->integer()
                    ->default(0)
                    ->required(),
            ]);
    }
}
