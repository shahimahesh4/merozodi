<?php

namespace App\Filament\Resources\ContactInquiries\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ContactInquiryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Sender Name')
                    ->disabled(),
                TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->disabled(),
                TextInput::make('phone')
                    ->label('Phone Number')
                    ->disabled(),
                TextInput::make('subject')
                    ->label('Subject')
                    ->disabled()
                    ->columnSpanFull(),
                Textarea::make('message')
                    ->label('Inquiry Message')
                    ->rows(5)
                    ->disabled()
                    ->columnSpanFull(),
                Select::make('status')
                    ->label('Resolution Status')
                    ->options([
                        'new' => 'New / Unreviewed',
                        'in_progress' => 'In Progress',
                        'resolved' => 'Resolved / Completed',
                    ])
                    ->required(),
                Toggle::make('is_read')
                    ->label('Marked as Read')
                    ->default(true),
                Textarea::make('admin_notes')
                    ->label('Internal Admin Notes / Follow-up Record')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }
}
