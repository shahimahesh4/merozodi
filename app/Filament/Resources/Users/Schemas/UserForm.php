<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->tel()
                    ->maxLength(20),
                Select::make('gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                        'other' => 'Other',
                    ])
                    ->required(),
                Select::make('profile_created_by')
                    ->options([
                        'self' => 'Self',
                        'parents' => 'Parents',
                        'sibling' => 'Sibling',
                        'relative' => 'Relative',
                        'friend' => 'Friend',
                    ])
                    ->default('self'),
                Select::make('marital_status')
                    ->options([
                        'unmarried' => 'Unmarried',
                        'widow' => 'Widow',
                        'divorced' => 'Divorced',
                        'separated' => 'Separated',
                    ])
                    ->default('unmarried'),
                Select::make('role')
                    ->options([
                        'user' => 'User',
                        'moderator' => 'Moderator',
                        'admin' => 'Admin',
                    ])
                    ->required(),
                Select::make('status')
                    ->options([
                        'active' => 'Active',
                        'pending_approval' => 'Pending Approval',
                        'suspended' => 'Suspended',
                        'deactivated' => 'Deactivated',
                    ])
                    ->required(),
                Toggle::make('is_verified')
                    ->label('Verified Profile Badge'),
                Toggle::make('is_premium')
                    ->label('Premium Membership Active'),
            ]);
    }
}
