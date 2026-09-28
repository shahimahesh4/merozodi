<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\UserVerifications\UserVerificationResource;
use App\Models\UserVerification;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class PendingVerificationsWidget extends BaseWidget
{
    protected static ?int $sort = 6;

    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->heading('Pending KYC Verifications (Action Required)')
            ->query(
                UserVerification::query()->with('user')->where('status', 'pending')->latest()->limit(5)
            )
            ->columns([
                TextColumn::make('user.name')
                    ->label('Applicant')
                    ->weight('bold')
                    ->description(fn (UserVerification $record): string => $record->user?->email ?? ''),

                TextColumn::make('document_type')
                    ->label('Document Type')
                    ->badge()
                    ->formatStateUsing(fn (string $state): string => ucwords(str_replace('_', ' ', $state)))
                    ->color('info'),

                TextColumn::make('document_number')
                    ->label('Document ID')
                    ->copyable(),

                TextColumn::make('created_at')
                    ->label('Submitted')
                    ->since()
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color('warning'),
            ])
            ->recordActions([
                Action::make('review')
                    ->label('Review & Verify')
                    ->icon('heroicon-m-check-badge')
                    ->color('primary')
                    ->button()
                    ->url(fn (UserVerification $record): string => UserVerificationResource::getUrl('edit', ['record' => $record])),
            ])
            ->emptyStateHeading('No pending KYC verifications')
            ->emptyStateDescription('All submitted identification documents have been verified.')
            ->emptyStateIcon('heroicon-o-shield-check')
            ->paginated(false);
    }
}
