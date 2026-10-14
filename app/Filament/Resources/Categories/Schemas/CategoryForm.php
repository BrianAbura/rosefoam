<?php

namespace App\Filament\Resources\Categories\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set(
                            'slug',
                            \Illuminate\Support\Str::slug($state)
                        );
                    }),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                Textarea::make('description')
                    ->rows(4)
                    ->columnSpanFull(),

                FileUpload::make('image')
                    ->image()
                    ->disk('public')
                    ->directory('categories')
                    ->visibility('public'),

                Toggle::make('is_active')
                    ->default(true),

                TextInput::make('sort_order')
                    ->numeric()
                    ->default(0)
                    ->required(),
            ]);
    }
}
