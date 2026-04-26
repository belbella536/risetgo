<?php

namespace App\Filament\Resources\Fakultas\Pages;

use App\Filament\Resources\Fakultas\FakultasResource;
use Filament\Resources\Pages\CreateRecord;

class CreateFakultas extends CreateRecord
{
    protected static string $resource = FakultasResource::class;

    protected function getHeaderActions(): array
    {
        return [
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
