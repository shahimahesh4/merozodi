<?php

namespace App\Filament\Resources\UserVerifications;

use App\Filament\Resources\UserVerifications\Pages\EditUserVerification;
use App\Filament\Resources\UserVerifications\Pages\ListUserVerifications;
use App\Filament\Resources\UserVerifications\Schemas\UserVerificationForm;
use App\Filament\Resources\UserVerifications\Tables\UserVerificationsTable;
use App\Models\UserVerification;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UserVerificationResource extends Resource
{
    protected static ?string $model = UserVerification::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedIdentification;

    protected static \UnitEnum|string|null $navigationGroup = 'Trust & Safety';

    protected static ?string $navigationLabel = 'KYC Verifications';

    protected static ?int $navigationSort = 1;

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('status', 'pending')->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'warning';
    }

    public static function form(Schema $schema): Schema
    {
        return UserVerificationForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UserVerificationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListUserVerifications::route('/'),
            'edit' => EditUserVerification::route('/{record}/edit'),
        ];
    }
}
