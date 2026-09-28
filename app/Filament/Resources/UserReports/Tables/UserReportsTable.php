<?php

namespace App\Filament\Resources\UserReports\Tables;

use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class UserReportsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('reporter.name')
                    ->label('Reporter')
                    ->searchable(),
                TextColumn::make('reported.name')
                    ->label('Reported Profile')
                    ->searchable()
                    ->weight('bold'),
                TextColumn::make('reason')
                    ->badge()
                    ->color('warning')
                    ->searchable(),
                TextColumn::make('details')
                    ->limit(40)
                    ->tooltip(fn ($record) => $record->details),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'resolved' => 'success',
                        'dismissed' => 'gray',
                        'investigating' => 'info',
                        default => 'danger',
                    }),
                TextColumn::make('created_at')
                    ->label('Reported Date')
                    ->dateTime('M d, Y h:i A')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'investigating' => 'Investigating',
                        'resolved' => 'Resolved',
                        'dismissed' => 'Dismissed',
                    ]),
            ])
            ->recordActions([
                Action::make('suspend_reported_user')
                    ->label('Suspend User')
                    ->icon('heroicon-m-no-symbol')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $record->reported->update(['status' => 'suspended']);
                        $record->update([
                            'status' => 'resolved',
                            'admin_resolution_notes' => 'User profile suspended due to verified community guidelines violation.',
                        ]);

                        Notification::make()
                            ->title('User Suspended')
                            ->body("User {$record->reported->name} has been suspended.")
                            ->danger()
                            ->send();
                    }),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
