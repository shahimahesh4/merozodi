<?php

namespace App\Filament\Resources\Blogs\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
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
                    ->label('Article Title')
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (string $operation, ?string $state, callable $set, callable $get) {
                        if ($operation === 'create' || blank($get('slug'))) {
                            $set('slug', Str::slug($state ?? ''));
                        }
                    }),
                TextInput::make('slug')
                    ->label('URL Slug')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (?string $state, callable $set) => $set('slug', Str::slug($state ?? '')))
                    ->suffixAction(
                        \Filament\Actions\Action::make('regenerateSlug')
                            ->icon('heroicon-m-arrow-path')
                            ->tooltip('Regenerate slug from title')
                            ->action(fn (callable $set, callable $get) => $set('slug', Str::slug($get('title') ?? '')))
                    )
                    ->helperText('Auto-generated from title and fully editable.'),
                Select::make('author_id')
                    ->relationship('author', 'name')
                    ->searchable()
                    ->default(fn () => auth()->id()),
                DateTimePicker::make('published_at')
                    ->label('Publication Date')
                    ->default(now()),
                FileUpload::make('featured_image')
                    ->label('Featured Header Banner Image')
                    ->image()
                    ->directory('blogs/banners')
                    ->visibility('public')
                    ->imageEditor()
                    ->maxSize(5120)
                    ->columnSpanFull()
                    ->helperText('Upload a high-quality cover / header banner image for this matrimonial article.'),
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
