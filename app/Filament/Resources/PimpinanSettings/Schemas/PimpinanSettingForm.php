<?php

namespace App\Filament\Resources\PimpinanSettings\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;

class PimpinanSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Menyimpan ID user yang sedang login secara otomatis
                Hidden::make('user_id')
                    ->default(auth()->id()),

                TextInput::make('nip')
                    ->label('NIP')
                    ->required()
                    ->numeric()
                    ->maxLength(50),

                TextInput::make('jabatan')
                    ->label('Jabatan')
                    ->placeholder('Contoh: Wakil Dekan I')
                    ->required()
                    ->maxLength(255),

                FileUpload::make('tanda_tangan_path')
                    ->label('Upload Tanda Tangan (Format .PNG Transparan)')
                    ->directory('tanda-tangan-pimpinan')
                    ->image()
                    ->preserveFilenames(),

                Toggle::make('is_active')
                    ->label('Status Aktif')
                    ->default(true),
            ]);
    }
}
