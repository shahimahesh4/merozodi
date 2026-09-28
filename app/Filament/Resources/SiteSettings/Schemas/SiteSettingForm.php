<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('key')
                    ->label('Setting Key Identifier')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255)
                    ->helperText('Unique technical key, e.g. support_phone, whatsapp_number, contact_email'),
                TextInput::make('label')
                    ->label('Display Label')
                    ->required()
                    ->maxLength(255)
                    ->helperText('Human-readable title, e.g. Customer Care Hotline'),
                Select::make('group')
                    ->label('Settings Group')
                    ->options([
                        'general' => 'General Information',
                        'contact' => 'Contact & Support Desk',
                        'social' => 'Social Media Links',
                        'payment' => 'Payment & Billing Gateways',
                        'astrology' => 'Vedic Astrology Parameters',
                    ])
                    ->default('general')
                    ->required(),
                Select::make('type')
                    ->label('Data Type')
                    ->options([
                        'text' => 'Single Line Text',
                        'textarea' => 'Multi-Line Text / Address',
                        'boolean' => 'Boolean Switch (true/false)',
                        'number' => 'Numeric Value',
                    ])
                    ->default('text')
                    ->required(),
                Textarea::make('value')
                    ->label('Setting Value')
                    ->rows(4)
                    ->columnSpanFull()
                    ->helperText('The configured value used across public and admin interfaces.'),
            ]);
    }
}
