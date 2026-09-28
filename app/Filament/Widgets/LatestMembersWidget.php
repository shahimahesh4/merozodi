<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\Users\UserResource;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestMembersWidget extends BaseWidget
{
    protected static ?int $sort = 5;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Recent Member Registrations')
            ->query(
                User::query()->latest()->limit(5)
            )
            ->columns([
                TextColumn::make('name')
                    ->label('Member Name')
                    ->searchable()
                    ->weight('bold')
                    ->description(fn (User $record): string => $record->email ?? ''),

                TextColumn::make('phone')
                    ->label('Contact')
                    ->placeholder('N/A'),

                TextColumn::make('gender')
                    ->label('Gender')
                    ->badge()
                    ->color(fn (string $state): string => match (strtolower($state)) {
                        'female' => 'primary',
                        'male' => 'info',
                        default => 'gray',
                    }),

                TextColumn::make('role')
                    ->label('Role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',
                        default => 'gray',
                    }),

                TextColumn::make('online_status')
                    ->label('Status')
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
                    ->label('Joined')
                    ->since()
                    ->sortable(),
            ])
            ->recordActions([
                Action::make('edit')
                    ->label('View / Edit')
                    ->icon('heroicon-m-pencil-square')
                    ->url(fn (User $record): string => UserResource::getUrl('edit', ['record' => $record])),
            ])
            ->paginated(false);
    }
}
