<?php

namespace App\Filament\Resources\PengajuanSurats\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use Filament\Schemas\Schema;

class PengajuanSuratForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Otomatis mengambil ID user yang sedang login
                Hidden::make('user_id')
                    ->default(auth()->id())
                    ->required(),

                // Opsi dari model Fakultas
                Select::make('fakultas_id')
                    ->label('Fakultas')
                    ->relationship('fakultas', 'nama_fakultas') // Pastikan relasi 'fakultas' ada di model & kolom 'nama' tersedia
                    ->searchable()
                    ->preload()
                    ->required(),

                // Opsi dari model Prodis
                Select::make('prodi_id')
                    ->label('Program Studi')
                    ->relationship('prodi', 'nama_prodi') // Pastikan relasi 'prodis' ada di model & kolom 'nama' tersedia
                    ->searchable()
                    ->preload()
                    ->required(),

                // no_surat_id dihapus dari form sesuai instruksi (akan diisi admin)

                TextInput::make('instansi_tujuan')
                    ->label('Instansi Tujuan')
                    ->required(),

                Textarea::make('judul_skripsi')
                    ->label('Judul Skripsi')
                    ->required()
                    ->columnSpanFull(),

                DatePicker::make('tanggal_mulai')
                    ->label('Tanggal Mulai')
                    ->required(),

                DatePicker::make('tanggal_selesai')
                    ->label('Tanggal Selesai')
                    ->required(),

                // Status disembunyikan dengan nilai default
                Hidden::make('status')
                    ->default('diajukan'),

                // Disposisi disembunyikan
                Hidden::make('disposisi'),
            ]);
    }
}
