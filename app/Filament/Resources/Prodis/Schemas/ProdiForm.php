<?php

namespace App\Filament\Resources\Prodis\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class ProdiForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_prodi')
                    ->label('Nama Prodi')
                    ->required()
                    ->maxLength(255),
            ]);
    }
}
