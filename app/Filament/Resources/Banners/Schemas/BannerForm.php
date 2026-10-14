<?php

namespace App\Filament\Resources\Banners\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class BannerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->maxLength(255),

                TextInput::make('subtitle')
                    ->maxLength(255),

                FileUpload::make('image_path')
                    ->image()
                    ->disk('public')
                    ->directory('banners')
                    ->visibility('public')
                    ->required(),

                TextInput::make('button_text')
                    ->placeholder('Shop Mattresses'),

                TextInput::make('button_url')
                    ->placeholder('/products'),

                Select::make('placement')
                    ->options([
                        'homepage_hero' => 'Homepage Hero',
                        'homepage_promo' => 'Homepage Promotion',
                    ])
                    ->required()
                    ->default('homepage_hero'),

                Toggle::make('is_active')
                    ->default(true),

                TextInput::make('sort_order')
                    ->numeric()
                    ->integer()
                    ->default(0),

                DateTimePicker::make('starts_at'),

                DateTimePicker::make('ends_at'),
            ]);
    }
}
