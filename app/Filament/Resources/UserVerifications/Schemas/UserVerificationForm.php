<?php

namespace App\Filament\Resources\UserVerifications\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserVerificationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->required()
                    ->disabled(),
                Select::make('document_type')
                    ->options([
                        'citizenship' => 'Nepali Citizenship (Nagarikta)',
                        'passport' => 'Passport',
                        'national_id' => 'National ID Card (Rastriya Parichayapatra)',
                        'driving_license' => 'Driving License',
                    ])
                    ->required(),
                TextInput::make('document_number')
                    ->required()
                    ->maxLength(255),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending Review',
                        'approved' => 'Approved (Verified Badge Granted)',
                        'rejected' => 'Rejected',
                    ])
                    ->required(),
                FileUpload::make('front_image_path')
                    ->label('Front Document Photo')
                    ->image()
                    ->disk('public')
                    ->directory('verifications')
                    ->openable()
                    ->downloadable(),
                FileUpload::make('back_image_path')
                    ->label('Back Document Photo')
                    ->image()
                    ->disk('public')
                    ->directory('verifications')
                    ->openable()
                    ->downloadable(),
                Textarea::make('admin_notes')
                    ->label('Internal Auditor Notes')
                    ->columnSpanFull(),
            ]);
    }
}
