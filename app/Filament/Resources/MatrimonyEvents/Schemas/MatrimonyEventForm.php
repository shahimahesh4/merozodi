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
                    ->required()
                    ->maxLength(255)
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn (string $operation, $state, callable $set) => $operation === 'create' ? $set('slug', Str::slug($state)) : null),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
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
                TextInput::make('banner_image')
                    ->label('Banner Image URL')
                    ->url()
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->rows(4)
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->label('Published & Open for Registration')
                    ->default(true),
            ]);
    }
}
