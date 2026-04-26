<?php

namespace App\Filament\Resources\NoSurats\Pages;

use App\Filament\Resources\NoSurats\NoSuratResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListNoSurats extends ListRecords
{
    protected static string $resource = NoSuratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()
                ->label('Tambah')
                ->icon('heroicon-o-plus')
                ->color('primary'),
        ];
    }
}
