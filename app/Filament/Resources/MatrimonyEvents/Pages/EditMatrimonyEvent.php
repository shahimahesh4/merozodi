<?php

namespace App\Filament\Resources\MatrimonyEvents\Pages;

use App\Filament\Resources\MatrimonyEvents\MatrimonyEventResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMatrimonyEvent extends EditRecord
{
    protected static string $resource = MatrimonyEventResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
