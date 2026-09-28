<?php

namespace App\Filament\Resources\Blogs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class BlogForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, callable $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                Select::make('author_id')
                    ->relationship('author', 'name')
                    ->searchable()
                    ->default(fn () => auth()->id()),
                DateTimePicker::make('published_at')
                    ->label('Publication Date')
                    ->default(now()),
                TextInput::make('featured_image')
                    ->label('Featured Image URL')
                    ->url()
                    ->columnSpanFull(),
                Textarea::make('summary')
                    ->label('Short Summary / Excerpt')
                    ->rows(2)
                    ->columnSpanFull(),
                Textarea::make('content')
                    ->label('Full Article Body')
                    ->rows(10)
                    ->required()
                    ->columnSpanFull(),
                Toggle::make('is_published')
                    ->label('Published Live')
                    ->default(true),
            ]);
    }
}
