<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use App\Models\User;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

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
            'admin' => Tab::make()
                ->badge(User::query()->where('role', 'admin')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('role', 'admin')),
            'mahasiswa' => Tab::make()
                ->badge(User::query()->where('role', 'mahasiswa')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('role', 'mahasiswa')),
            'pimpinan' => Tab::make()
                ->badge(User::query()->where('role', 'pimpinan')->count())
                ->modifyQueryUsing(fn (Builder $query) => $query->where('role', 'pimpinan')),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
