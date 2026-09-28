<?php

namespace App\Filament\Resources\UserVerifications\Pages;

use App\Filament\Resources\UserVerifications\UserVerificationResource;
use Filament\Resources\Pages\ListRecords;

class ListUserVerifications extends ListRecords
{
    protected static string $resource = UserVerificationResource::class;
}
