<?php

namespace App\Filament\Resources\UserVerifications\Tables;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class UserVerificationsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Member Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('user.email')
                    ->label('Email')
                    ->searchable(),
                TextColumn::make('document_type')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'citizenship' => 'Citizenship',
                        'passport' => 'Passport',
                        'national_id' => 'National ID',
                        'driving_license' => 'License',
                        default => ucfirst($state),
                    })
                    ->color('info'),
                TextColumn::make('document_number')
                    ->fontFamily('mono')
                    ->searchable(),
                ImageColumn::make('front_image_path')
                    ->label('Front')
                    ->disk('public')
                    ->circular(false)
                    ->square(),
                ImageColumn::make('back_image_path')
                    ->label('Back')
                    ->disk('public')
                    ->circular(false)
                    ->square(),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'approved' => 'success',
                        'rejected' => 'danger',
                        default => 'warning',
                    }),
                TextColumn::make('created_at')
                    ->label('Submitted')
                    ->dateTime('M d, Y h:i A')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'pending' => 'Pending Review',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected',
                    ]),
                SelectFilter::make('document_type')
                    ->options([
                        'citizenship' => 'Citizenship',
                        'passport' => 'Passport',
                        'national_id' => 'National ID',
                        'driving_license' => 'Driving License',
                    ]),
            ])
            ->recordActions([
                Action::make('approve')
                    ->label('Approve KYC')
                    ->icon('heroicon-m-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status !== 'approved')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'approved',
                            'verified_at' => now(),
                            'verified_by' => auth()->id(),
                        ]);
                        $record->user->update(['is_verified' => true]);

                        Notification::make()
                            ->title('KYC Approved')
                            ->body("User {$record->user->name} has been verified.")
                            ->success()
                            ->send();
                    }),
                Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-m-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->visible(fn ($record) => $record->status !== 'rejected')
                    ->action(function ($record) {
                        $record->update([
                            'status' => 'rejected',
                            'verified_at' => null,
                        ]);
                        $record->user->update(['is_verified' => false]);

                        Notification::make()
                            ->title('KYC Rejected')
                            ->body("Verification for {$record->user->name} rejected.")
                            ->warning()
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
