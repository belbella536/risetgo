<?php

namespace App\Filament\Resources\ApprovalSurats\Pages;

use App\Filament\Resources\ApprovalSurats\ApprovalSuratResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListApprovalSurats extends ListRecords
{
    protected static string $resource = ApprovalSuratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // CreateAction::make(),
        ];
    }

}
