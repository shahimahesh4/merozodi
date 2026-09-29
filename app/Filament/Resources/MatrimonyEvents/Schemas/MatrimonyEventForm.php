<?php

namespace App\Filament\Resources\MatrimonyEvents\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class MatrimonyEventForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Event Title')
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
                Select::make('type')
                    ->options([
                        'physical' => 'In-Person Physical Mixer',
                        'virtual_meet' => 'Virtual Speed Meet',
                    ])
                    ->required(),
                DateTimePicker::make('event_datetime')
                    ->label('Date & Time')
                    ->required(),
                TextInput::make('location_venue')
                    ->label('Venue / Meeting Link')
                    ->maxLength(255),
                TextInput::make('entry_fee_npr')
                    ->label('Entry Fee (NPR)')
                    ->numeric()
                    ->prefix('NPR')
                    ->default(0),
                TextInput::make('max_participants')
                    ->numeric()
                    ->label('Max Capacity'),
                FileUpload::make('banner_image')
                    ->label('Event Header Banner Poster')
                    ->image()
                    ->directory('events/banners')
                    ->visibility('public')
                    ->imageEditor()
                    ->maxSize(5120)
                    ->columnSpanFull()
                    ->helperText('Upload an event promotional banner / poster image.'),
                Textarea::make('description')
                    ->rows(4)
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Published & Open for Registration')
                    ->default(true),
            ]);
    }
}
