<?php

namespace App\Filament\Resources\ApprovalSurats\Pages;

use App\Filament\Resources\ApprovalSurats\ApprovalSuratResource;
use Filament\Resources\Pages\CreateRecord;

class CreateApprovalSurat extends CreateRecord
{
    protected static string $resource = ApprovalSuratResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
