<?php

namespace App\Filament\Resources\Coupons\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CouponsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('code')
                    ->label('Promo Code')
                    ->badge()
                    ->color('primary')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('name')
                    ->label('Campaign Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('discount_type')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'percentage' ? 'success' : 'info')
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                TextColumn::make('discount_value')
                    ->label('Discount')
                    ->formatStateUsing(fn ($record) => $record->discount_type === 'percentage' 
                        ? $record->discount_value . '%' 
                        : 'NPR ' . number_format($record->discount_value, 2))
                    ->weight('bold'),
                TextColumn::make('min_order_amount')
                    ->label('Min. Subtotal')
                    ->money('NPR')
                    ->sortable(),
                TextColumn::make('times_used')
                    ->label('Redemptions')
                    ->formatStateUsing(fn ($record) => $record->times_used . ($record->max_uses ? ' / ' . $record->max_uses : ''))
                    ->sortable(),
                TextColumn::make('expires_at')
                    ->label('Expires At')
                    ->dateTime('M d, Y')
                    ->placeholder('Never Expires')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
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
