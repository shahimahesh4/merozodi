<?php

namespace App\Filament\Resources\UserReports;

use App\Filament\Resources\UserReports\Pages\EditUserReport;
use App\Filament\Resources\UserReports\Pages\ListUserReports;
use App\Filament\Resources\UserReports\Schemas\UserReportForm;
use App\Filament\Resources\UserReports\Tables\UserReportsTable;
use App\Models\UserReport;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class UserReportResource extends Resource
{
    protected static ?string $model = UserReport::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedExclamationTriangle;

    protected static \UnitEnum|string|null $navigationGroup = 'Trust & Safety';

    protected static ?string $navigationLabel = 'Moderation & Reports';

    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        $count = static::getModel()::where('status', 'pending')->count();
        return $count > 0 ? (string) $count : null;
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return 'danger';
    }

    public static function form(Schema $schema): Schema
    {
        return UserReportForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UserReportsTable::configure($table);
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
            'index' => ListUserReports::route('/'),
            'edit' => EditUserReport::route('/{record}/edit'),
        ];
    }
}
