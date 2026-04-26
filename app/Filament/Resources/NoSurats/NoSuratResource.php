<?php

namespace App\Filament\Resources\NoSurats;

use App\Filament\Resources\NoSurats\Pages\CreateNoSurat;
use App\Filament\Resources\NoSurats\Pages\EditNoSurat;
use App\Filament\Resources\NoSurats\Pages\ListNoSurats;
use App\Filament\Resources\NoSurats\Schemas\NoSuratForm;
use App\Filament\Resources\NoSurats\Tables\NoSuratsTable;
use App\Models\NoSurat;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class NoSuratResource extends Resource
{
    protected static ?string $model = NoSurat::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $modelLabel = 'Nomor Surat';

    protected static ?string $pluralModelLabel = 'Nomor Surat';

    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->role === 'admin';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Data Akademik';
    }

    public static function getNavigationLabel(): string
    {
        return 'Nomor Surat';
    }

    public static function form(Schema $schema): Schema
    {
        return NoSuratForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NoSuratsTable::configure($table);
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
            'index' => ListNoSurats::route('/'),
            // 'create' => CreateNoSurat::route('/create'),
            // 'edit' => EditNoSurat::route('/{record}/edit'),
        ];
    }
}
