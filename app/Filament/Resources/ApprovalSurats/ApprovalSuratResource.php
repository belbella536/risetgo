<?php

namespace App\Filament\Resources\ApprovalSurats;

use App\Filament\Resources\ApprovalSurats\Pages\CreateApprovalSurat;
use App\Filament\Resources\ApprovalSurats\Pages\EditApprovalSurat;
use App\Filament\Resources\ApprovalSurats\Pages\ListApprovalSurats;
use App\Filament\Resources\ApprovalSurats\Schemas\ApprovalSuratForm;
use App\Filament\Resources\ApprovalSurats\Tables\ApprovalSuratsTable;
use App\Models\PengajuanSurat;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ApprovalSuratResource extends Resource
{
    protected static ?string $model = PengajuanSurat::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->role === 'pimpinan';
    }

    protected static ?string $modelLabel = 'Approval Surat';

    protected static ?string $pluralModelLabel = 'Approval Surat';

    public static function getNavigationLabel(): string
    {
        return 'Approval Surat';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Approval Surat';
    }

    public static function form(Schema $schema): Schema
    {
        return ApprovalSuratForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ApprovalSuratsTable::configure($table);
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
            'index' => ListApprovalSurats::route('/'),
            'create' => CreateApprovalSurat::route('/create'),
            'edit' => EditApprovalSurat::route('/{record}/edit'),
        ];
    }
}
