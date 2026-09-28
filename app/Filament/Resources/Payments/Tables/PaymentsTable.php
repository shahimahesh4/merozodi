<?php

namespace App\Filament\Resources\Payments\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class PaymentsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('transaction_id')
                    ->label('Txn ID')
                    ->fontFamily('mono')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('user.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('gateway')
                    ->label('Gateway')
                    ->badge()
                    ->color(fn (string $state): string => match (strtolower($state)) {
                        'esewa' => 'success',
                        'khalti' => 'primary',
                        'fonepay' => 'danger',
                        'connectips' => 'info',
                        default => 'gray',
                    })
                    ->searchable(),
                TextColumn::make('total_amount')
                    ->label('Total Paid')
                    ->money('NPR')
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('gateway_reference')
                    ->label('Gateway Ref')
                    ->fontFamily('mono')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'completed' => 'success',
                        'failed' => 'danger',
                        'refunded' => 'warning',
                        default => 'gray',
                    }),
                TextColumn::make('created_at')
                    ->label('Date & Time')
                    ->dateTime('M d, Y h:i A')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'completed' => 'Completed',
                        'pending' => 'Pending',
                        'failed' => 'Failed',
                    ]),
                SelectFilter::make('gateway')
                    ->options([
                        'esewa' => 'eSewa',
                        'khalti' => 'Khalti',
                        'fonepay' => 'Fonepay',
                        'connectips' => 'ConnectIPS',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
