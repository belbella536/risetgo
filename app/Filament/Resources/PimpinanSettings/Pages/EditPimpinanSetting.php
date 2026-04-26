<?php

namespace App\Filament\Resources\PimpinanSettings\Pages;

use App\Filament\Resources\PimpinanSettings\PimpinanSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPimpinanSetting extends EditRecord
{
    protected static string $resource = PimpinanSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
