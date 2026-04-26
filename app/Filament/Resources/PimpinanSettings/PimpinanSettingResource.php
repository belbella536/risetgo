<?php

namespace App\Filament\Resources\PimpinanSettings;

use App\Filament\Resources\PimpinanSettings\Pages\CreatePimpinanSetting;
use App\Filament\Resources\PimpinanSettings\Pages\EditPimpinanSetting;
use App\Filament\Resources\PimpinanSettings\Pages\ListPimpinanSettings;
use App\Filament\Resources\PimpinanSettings\Schemas\PimpinanSettingForm;
use App\Filament\Resources\PimpinanSettings\Tables\PimpinanSettingsTable;
use App\Models\PimpinanSetting;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PimpinanSettingResource extends Resource
{
    protected static ?string $model = PimpinanSetting::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->role === 'pimpinan';
    }

    public static function form(Schema $schema): Schema
    {
        return PimpinanSettingForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PimpinanSettingsTable::configure($table);
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
            'index' => ListPimpinanSettings::route('/'),
            'create' => CreatePimpinanSetting::route('/create'),
            'edit' => EditPimpinanSetting::route('/{record}/edit'),
        ];
    }
}
