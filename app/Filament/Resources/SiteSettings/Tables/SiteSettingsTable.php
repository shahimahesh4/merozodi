<?php

namespace App\Filament\Resources\SiteSettings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class SiteSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('label')
                    ->label('Setting Label')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('key')
                    ->label('Key')
                    ->badge()
                    ->color('gray')
                    ->fontFamily('mono')
                    ->searchable(),
                TextColumn::make('value')
                    ->label('Current Value')
                    ->limit(50)
                    ->searchable(),
                TextColumn::make('group')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'general' => 'primary',
                        'footer' => 'info',
                        'contact' => 'success',
                        'social' => 'warning',
                        'homepage' => 'danger',
                        'homepage_stats' => 'info',
                        'payment' => 'success',
                        'astrology' => 'warning',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => ucfirst(str_replace('_', ' ', $state))),
                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('M d, Y h:i A')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('group')
                    ->options([
                        'general' => 'General Information',
                        'footer' => 'Footer & Legal',
                        'contact' => 'Contact & Support',
                        'social' => 'Social Media',
                        'homepage' => 'Homepage Sections',
                        'homepage_stats' => 'Homepage Stats',
                        'payment' => 'Payment Gateways',
                        'astrology' => 'Astrology',
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
