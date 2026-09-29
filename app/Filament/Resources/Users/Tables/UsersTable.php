<?php

namespace App\Filament\Resources\Users\Tables;

use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar_url')
                    ->label('Avatar')
                    ->circular(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('phone')
                    ->searchable(),
                TextColumn::make('gender')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'female' => 'danger',
                        'male' => 'info',
                        default => 'gray',
                    }),
                TextColumn::make('role')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'super_admin' => 'Super Admin',
                        'admin' => 'Admin',
                        'staff' => 'Staff / Support',
                        'moderator' => 'Moderator',
                        default => 'User',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'super_admin' => 'danger',
                        'admin' => 'primary',
                        'staff', 'moderator' => 'warning',
                        default => 'gray',
                    }),
                IconColumn::make('is_verified')
                    ->boolean()
                    ->label('Verified'),
                IconColumn::make('is_premium')
                    ->boolean()
                    ->label('Premium'),
                TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'suspended' => 'danger',
                        default => 'warning',
                    }),
                TextColumn::make('online_status')
                    ->label('Activity')
                    ->badge()
                    ->icon(fn (string $state): ?string => match ($state) {
                        'Online Now' => 'heroicon-m-signal',
                        default => 'heroicon-m-moon',
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'Online Now' => 'success',
                        'Offline' => 'gray',
                        default => 'info',
                    }),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TernaryFilter::make('is_verified')
                    ->label('Verification Status')
                    ->trueLabel('Verified Profiles Only')
                    ->falseLabel('Pending / Unverified Profiles'),
                SelectFilter::make('gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                    ]),
                SelectFilter::make('role')
                    ->options([
                        'super_admin' => 'Super Admin',
                        'admin' => 'Admin',
                        'staff' => 'Staff / Support',
                        'user' => 'User',
                    ]),
                SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'pending_approval' => 'Pending Approval',
                        'suspended' => 'Suspended',
                    ]),
            ])
            ->recordActions([
                Action::make('verify')
                    ->label('Verify & Approve')
                    ->icon('heroicon-m-check-badge')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Verify & Approve Member Profile')
                    ->modalDescription('Are you sure you want to verify this member? Once approved, their profile will be publicly visible to prospective matches on the browse directory.')
                    ->visible(fn (User $record) => !$record->is_verified || $record->status !== 'active')
                    ->action(function (User $record) {
                        $record->update([
                            'is_verified' => true,
                            'status' => 'active',
                        ]);

                        Notification::make()
                            ->title('Profile Approved & Verified')
                            ->body("Member {$record->name} is now verified and active on MeroZodi.")
                            ->success()
                            ->send();
                    }),
                Action::make('unverify')
                    ->label('Revoke Verification')
                    ->icon('heroicon-m-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->modalHeading('Revoke Verification')
                    ->modalDescription('Are you sure you want to revoke verification for this member? Their profile will be hidden from public browsing.')
                    ->visible(fn (User $record) => $record->is_verified)
                    ->action(function (User $record) {
                        $record->update([
                            'is_verified' => false,
                            'status' => 'pending_approval',
                        ]);

                        Notification::make()
                            ->title('Verification Revoked')
                            ->body("Member {$record->name} verification revoked. Profile status set to Pending Review.")
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
