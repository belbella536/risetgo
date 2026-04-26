<?php

namespace App\Filament\Resources\Fakultas\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class FakultasForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_fakultas')
                    ->label('Nama Fakultas')
                    ->required()
                    ->maxLength(255),
            ]);
    }
}
