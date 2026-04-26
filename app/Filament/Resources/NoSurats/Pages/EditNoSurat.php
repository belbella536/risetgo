<?php

namespace App\Filament\Resources\NoSurats\Pages;

use App\Filament\Resources\NoSurats\NoSuratResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditNoSurat extends EditRecord
{
    protected static string $resource = NoSuratResource::class;

    protected function getHeaderActions(): array
    {
        return [
           DeleteAction::make(),
            Action::make('back')
                ->label('Kembali')
                ->icon('heroicon-o-arrow-left')
                ->color('gray')
                ->url(static::getResource()::getUrl('index')),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
