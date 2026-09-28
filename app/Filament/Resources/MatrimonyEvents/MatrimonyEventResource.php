<?php

namespace App\Filament\Resources\MatrimonyEvents;

use App\Filament\Resources\MatrimonyEvents\Pages\CreateMatrimonyEvent;
use App\Filament\Resources\MatrimonyEvents\Pages\EditMatrimonyEvent;
use App\Filament\Resources\MatrimonyEvents\Pages\ListMatrimonyEvents;
use App\Filament\Resources\MatrimonyEvents\Schemas\MatrimonyEventForm;
use App\Filament\Resources\MatrimonyEvents\Tables\MatrimonyEventsTable;
use App\Models\MatrimonyEvent;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MatrimonyEventResource extends Resource
{
    protected static ?string $model = MatrimonyEvent::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedCalendarDays;

    protected static \UnitEnum|string|null $navigationGroup = 'Events & Community';

    protected static ?string $navigationLabel = 'Matrimonial Events';

    public static function form(Schema $schema): Schema
    {
        return MatrimonyEventForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MatrimonyEventsTable::configure($table);
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
            'index' => ListMatrimonyEvents::route('/'),
            'create' => CreateMatrimonyEvent::route('/create'),
            'edit' => EditMatrimonyEvent::route('/{record}/edit'),
        ];
    }
}
