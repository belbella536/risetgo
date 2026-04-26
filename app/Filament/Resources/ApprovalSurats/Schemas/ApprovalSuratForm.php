<?php

namespace App\Filament\Resources\ApprovalSurats\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DatePicker;
use App\Models\User;
use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\NoSurat;


class ApprovalSuratForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('no_surat_id')
                    ->label('Nomor Surat')
                    ->disabled()
                    ->options(NoSurat::all()->pluck('nomor', 'id')),

                Select::make('user_id')
                    ->label('Nama')
                    ->disabled()
                    ->options(User::all()->pluck('name', 'id')),

                Select::make('user_id')
                    ->label('NIM')
                    ->disabled()
                    ->options(User::all()->pluck('username', 'id')),
                
                Select::make('fakultas_id')
                    ->label('Fakultas')
                    ->disabled()
                    ->options(Fakultas::all()->pluck('nama_fakultas', 'id')),

                Select::make('prodi_id')
                    ->label('Prodi')
                    ->disabled()
                    ->options(Prodi::all()->pluck('nama_prodi', 'id')),

                TextInput::make('instansi_tujuan')
                    ->label('Instansi Tujuan')
                    ->disabled(),

                Textarea::make('judul_skripsi')
                    ->label('Judul Skripsi')
                    ->disabled(),

                DatePicker::make('tanggal_mulai')
                    ->label('Tanggal Mulai')
                    ->disabled(),

                DatePicker::make('tanggal_selesai')
                    ->label('Tanggal Selesai')
                    ->disabled(),
                TextArea::make('keterangan')
                    ->label('Keterangan'),                 
            ]);
    }
}
