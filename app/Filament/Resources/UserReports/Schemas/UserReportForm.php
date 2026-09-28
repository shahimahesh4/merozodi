<?php

namespace App\Filament\Resources\UserReports\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserReportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('reporter_id')
                    ->relationship('reporter', 'name')
                    ->label('Reported By')
                    ->required()
                    ->disabled(),
                Select::make('reported_id')
                    ->relationship('reported', 'name')
                    ->label('Accused User Profile')
                    ->required()
                    ->disabled(),
                TextInput::make('reason')
                    ->label('Report Reason')
                    ->required()
                    ->disabled(),
                Textarea::make('details')
                    ->label('Report Details / Context')
                    ->rows(3)
                    ->disabled()
                    ->columnSpanFull(),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending Review',
                        'investigating' => 'Under Investigation',
                        'resolved' => 'Resolved (Action Taken)',
                        'dismissed' => 'Dismissed (False Report)',
                    ])
                    ->required(),
                Textarea::make('admin_resolution_notes')
                    ->label('Admin Findings & Resolution Notes')
                    ->rows(4)
                    ->columnSpanFull(),
            ]);
    }
}
