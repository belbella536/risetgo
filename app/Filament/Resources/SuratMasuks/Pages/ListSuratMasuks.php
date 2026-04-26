<?php

namespace App\Filament\Resources\SuratMasuks\Pages;

use App\Filament\Resources\SuratMasuks\SuratMasukResource;
use Filament\Actions\CreateAction;
use App\Models\PengajuanSurat;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListSuratMasuks extends ListRecords
{
    protected static string $resource = SuratMasukResource::class;

    protected function getHeaderActions(): array
    {
        return [
           CreateAction::make()
                ->label('Tambah')
                ->icon('heroicon-o-plus')
                ->color('primary'),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make(),
            'diajukan' => Tab::make()
                ->badge(PengajuanSurat::query()->where('status', 'diajukan')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'diajukan')),
            'ditolak' => Tab::make()
                ->badge(PengajuanSurat::query()->where('status', 'ditolak')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'ditolak')),
            'selesai' => Tab::make()
                ->badge(PengajuanSurat::query()->where('status', 'selesai')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'selesai')),
        ];
    }
}
