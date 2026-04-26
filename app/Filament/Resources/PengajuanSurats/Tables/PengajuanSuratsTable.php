<?php

namespace App\Filament\Resources\PengajuanSurats\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PengajuanSuratsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            // Menambahkan filter agar query hanya memanggil data milik user yang login
            ->modifyQueryUsing(fn (Builder $query) => $query->where('user_id', auth()->id()))
            ->columns([
                TextColumn::make('No.')
                    ->label('No.')
                    ->rowIndex(),
                    
                // Mengambil field 'nomor' dari relasi 'noSurat'
                TextColumn::make('no_surat.nomor')
                    ->label('Nomor Surat')
                    ->default('Proses')
                    // Opsional: Beri warna merah jika belum ada nomor, hijau jika sudah ada
                    ->color(fn ($state): string => $state === 'Proses' ? 'danger' : 'success')
                    ->badge() // Opsional: Menjadikannya bentuk badge agar lebih mencolok
                    ->sortable(),
                    
                TextColumn::make('instansi_tujuan')
                    ->label('Instansi Tujuan')
                    ->searchable(),
                TextColumn::make('tanggal_mulai')
                    ->label('Tanggal Mulai')
                    ->date()
                    ->sortable(),
                TextColumn::make('tanggal_selesai')
                    ->label('Tanggal Selesai')
                    ->date()
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($state): string => $state === 'Selesai' ? 'success' : 'warning')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                // Mahasiswa hanya bisa melihat detail data tanpa mengedit
                ViewAction::make()
                    ->button()
                    ->outlined()
                    ->color('info')
                    ->label(' '),
                // Edit hanya muncul jika user memiliki role 'admin'
                EditAction::make()
                    ->button()
                    ->outlined()
                    ->visible(fn () => auth()->user()->role === 'admin'), // Sesuaikan 'role' dan 'admin' dengan database Anda
                
                // Action Cetak Berkas
                Action::make('cetak_berkas')
                    ->label(' ')
                    ->button()
                    ->outlined()
                    ->icon('heroicon-o-printer')
                    ->color('success')
                    // Tombol hanya tampil jika status Selesai DAN kolom document_path tidak kosong
                    ->visible(fn ($record) => $record->status === 'Selesai' && $record->document_path)
                    // Langsung arahkan ke URL file di storage
                    ->url(fn ($record) => asset('storage/' . $record->document_path))
                    ->openUrlInNewTab(),
            ])
            ->toolbarActions([
                // Tombol hapus massal hanya muncul untuk admin
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ])->visible(fn () => auth()->user()->role === 'admin'),
            ]);
    }
}
