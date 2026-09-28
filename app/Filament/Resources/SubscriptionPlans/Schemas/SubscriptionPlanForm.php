<?php

namespace App\Filament\Resources\SubscriptionPlans\Schemas;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SubscriptionPlanForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                TextInput::make('duration_months')
                    ->numeric()
                    ->required()
                    ->label('Duration (Months)'),
                TextInput::make('price_npr')
                    ->numeric()
                    ->prefix('NPR')
                    ->required(),
                TextInput::make('price_usd')
                    ->numeric()
                    ->prefix('$')
                    ->default(0),
                Textarea::make('description')
                    ->columnSpanFull(),
                Toggle::make('allows_direct_messaging')
                    ->label('Allows Direct Messaging')
                    ->default(true),
                Toggle::make('allows_video_calling')
                    ->label('Allows 1-on-1 Video Calling')
                    ->default(true),
                Toggle::make('allows_contact_view')
                    ->label('Allows Verified Contact Numbers View')
                    ->default(true),
                Toggle::make('is_popular')
                    ->label('Highlighted as Most Popular / Recommended'),
                Toggle::make('is_active')
                    ->label('Active for Purchase')
                    ->default(true),
            ]);
    }
}
