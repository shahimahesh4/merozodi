<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->disabled(),
                TextInput::make('transaction_id')
                    ->required()
                    ->disabled(),
                Select::make('gateway')
                    ->options([
                        'esewa' => 'eSewa',
                        'khalti' => 'Khalti',
                        'fonepay' => 'Fonepay',
                        'connectips' => 'ConnectIPS',
                        'stripe' => 'Stripe',
                        'manual' => 'Manual',
                    ])
                    ->required(),
                TextInput::make('gateway_reference'),
                TextInput::make('amount')
                    ->numeric()
                    ->prefix('NPR')
                    ->required(),
                TextInput::make('tax_amount')
                    ->numeric()
                    ->prefix('NPR')
                    ->label('13% VAT Amount'),
                TextInput::make('total_amount')
                    ->numeric()
                    ->prefix('NPR')
                    ->required(),
                Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'completed' => 'Completed',
                        'failed' => 'Failed',
                        'refunded' => 'Refunded',
                    ])
                    ->required(),
            ]);
    }
}
