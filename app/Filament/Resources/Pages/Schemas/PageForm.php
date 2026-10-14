<?php

namespace App\Filament\Resources\Pages\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;

class PageForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('slug', \Illuminate\Support\Str::slug($state));
                    }),

                TextInput::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),

                RichEditor::make('content')
                    ->columnSpanFull(),

                TextInput::make('meta_title')
                    ->maxLength(255),

                TextInput::make('meta_description')
                    ->maxLength(500),

                Toggle::make('is_published')
                    ->default(false),

                DateTimePicker::make('published_at'),
            ]);
    }
}
