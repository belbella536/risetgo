<?php

namespace App\Filament\Resources\PengajuanSurats;

use App\Filament\Resources\PengajuanSurats\Pages\CreatePengajuanSurat;
use App\Filament\Resources\PengajuanSurats\Pages\EditPengajuanSurat;
use App\Filament\Resources\PengajuanSurats\Pages\ListPengajuanSurats;
use App\Filament\Resources\PengajuanSurats\Schemas\PengajuanSuratForm;
use App\Filament\Resources\PengajuanSurats\Tables\PengajuanSuratsTable;
use App\Models\PengajuanSurat;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PengajuanSuratResource extends Resource
{
    protected static ?string $model = PengajuanSurat::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nomor';

    protected static ?string $modelLabel = 'Pengajuan Surat';

    protected static ?string $pluralModelLabel = 'Pengajuan Surat';

    public static function getNavigationLabel(): string
    {
        return 'Pengajuan Surat';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Pengajuan Izin Penelitian';
    }

    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->role === 'mahasiswa';
    }

    public static function form(Schema $schema): Schema
    {
        return PengajuanSuratForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PengajuanSuratsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPengajuanSurats::route('/'),
            // 'create' => CreatePengajuanSurat::route('/create'),
            // 'edit' => EditPengajuanSurat::route('/{record}/edit'),
        ];
    }
}
