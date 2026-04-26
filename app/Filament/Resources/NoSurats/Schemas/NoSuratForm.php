<?php

namespace App\Filament\Resources\NoSurats\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;

class NoSuratForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nomor')
                    ->label('Nomor Surat')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Contoh: 123456'),
                            
                Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->default(false)
                    ->columnSpanFull(),
            ]);
    }
}
