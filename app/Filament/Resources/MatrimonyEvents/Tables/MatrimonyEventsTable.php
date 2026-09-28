<?php

namespace App\Filament\Resources\MatrimonyEvents\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class MatrimonyEventsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('type')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'virtual_meet' => 'info',
                        default => 'warning',
                    }),
                TextColumn::make('event_datetime')
                    ->label('Event Schedule')
                    ->dateTime('M d, Y h:i A')
                    ->sortable(),
                TextColumn::make('location_venue')
                    ->label('Venue')
                    ->limit(30)
                    ->searchable(),
                TextColumn::make('entry_fee_npr')
                    ->label('Fee')
                    ->money('NPR')
                    ->sortable(),
                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
            ])
            ->filters([
                SelectFilter::make('type')
                    ->options([
                        'physical' => 'In-Person',
                        'virtual_meet' => 'Virtual Meet',
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
