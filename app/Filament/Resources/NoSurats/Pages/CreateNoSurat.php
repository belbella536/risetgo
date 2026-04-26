<?php

namespace App\Filament\Resources\NoSurats\Pages;

use App\Filament\Resources\NoSurats\NoSuratResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNoSurat extends CreateRecord
{
    protected static string $resource = NoSuratResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
