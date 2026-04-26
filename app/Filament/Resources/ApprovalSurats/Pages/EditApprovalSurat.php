<?php

namespace App\Filament\Resources\ApprovalSurats\Pages;

use App\Filament\Resources\ApprovalSurats\ApprovalSuratResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditApprovalSurat extends EditRecord
{
    protected static string $resource = ApprovalSuratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
