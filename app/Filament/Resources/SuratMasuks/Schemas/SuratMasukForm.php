<?php

namespace App\Filament\Resources\SuratMasuks\Schemas;

use Filament\Schemas\Schema;
use App\Models\NoSurat;
use App\Models\User;
use App\Models\PengajuanSurat;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Wizard;
use Filament\Schemas\Components\Wizard\Step;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Flex;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Infolists\Components\TextEntry;
use Filament\Support\Enums\FontWeight;         

class SuratMasukForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Flex::make([
                    Section::make([
                        Select::make('user_id')
                            ->label('Nama')
                            ->disabled()
                            ->options(User::all()->pluck('name', 'id')),
                        Select::make('user_id')
                            ->label('NIM')
                            ->disabled()
                            ->options(User::all()->pluck('username', 'id')),
                        TextInput::make('instansi_tujuan')
                            ->label('Instansi Tujuan'),
                        Textarea::make('judul_skripsi')
                            ->label('Judul Skripsi'),
                        DatePicker::make('tanggal_mulai')
                            ->label('Tanggal Mulai'),
                        DatePicker::make('tanggal_selesai')
                            ->label('Tanggal Selesai'),
                    ]),
                    Section::make([
                        TextInput::make('nomor_surat')
                            ->label('Nomor Surat')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Contoh: 123456'),
                        Select::make('no_surat_id')
                            ->label('Nomor Surat')
                            ->options(NoSurat::where('is_active', true)->pluck('nomor', 'id'))
                            ->required()
                            ->searchable(),
                        Select::make('disposisi')
                            ->label('Disposisi Pimpinan')
                            ->options(User::where('role', 'pimpinan')->pluck('name', 'id'))
                            ->required()
                            ->searchable(),  
                        TextEntry::make('description')
                            ->label('Catatan Sistem')
                            ->default('Data Pengajuan Surat Izin Penelitian ini dalam status Verifikasi oleh Akademik')
                            ->color('primary')
                            ->icon('heroicon-m-information-circle') 
                            ->iconColor('primary'), 
                    ])->columnSpanFull(),
                ])->columnSpanFull()             
        ]);
    }
}
