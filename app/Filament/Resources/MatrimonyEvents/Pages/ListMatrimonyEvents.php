<?php

namespace App\Filament\Resources\MatrimonyEvents\Pages;

use App\Filament\Resources\MatrimonyEvents\MatrimonyEventResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMatrimonyEvents extends ListRecords
{
    protected static string $resource = MatrimonyEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
