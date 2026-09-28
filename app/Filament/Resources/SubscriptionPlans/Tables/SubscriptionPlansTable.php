<?php

namespace App\Filament\Resources\SubscriptionPlans\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SubscriptionPlansTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('duration_months')
                    ->label('Duration')
                    ->suffix(' Months')
                    ->sortable(),
                TextColumn::make('price_npr')
                    ->label('Price (NPR)')
                    ->money('NPR')
                    ->sortable()
                    ->weight('bold'),
                IconColumn::make('allows_direct_messaging')
                    ->boolean()
                    ->label('Chat'),
                IconColumn::make('allows_video_calling')
                    ->boolean()
                    ->label('Video'),
                IconColumn::make('allows_contact_view')
                    ->boolean()
                    ->label('Contacts'),
                IconColumn::make('is_popular')
                    ->boolean()
                    ->label('Popular'),
                IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
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
