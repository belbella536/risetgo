<?php

namespace App\Filament\Resources\PimpinanSettings\Pages;

use App\Filament\Resources\PimpinanSettings\PimpinanSettingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPimpinanSettings extends ListRecords
{
    protected static string $resource = PimpinanSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
