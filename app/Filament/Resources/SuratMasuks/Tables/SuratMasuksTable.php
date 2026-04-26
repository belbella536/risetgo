<?php

namespace App\Filament\Resources\SuratMasuks\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\Action;
use App\Services\Api;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class SuratMasuksTable
{
    public static function configure(Table $table): Table
    {
        return $table
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
                TextColumn::make('user.name')
                    ->label('Nama')
                    ->sortable(),
                TextColumn::make('user.username')
                    ->label('NIM')
                    ->sortable(),
                TextColumn::make('instansi_tujuan')
                    ->label('Instansi Tujuan')
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
                EditAction::make()
                    ->button()
                    ->outlined()
                    ->label(' '),
                Action::make('send')
                    ->label('Kirim WA')
                    ->button()
                    ->outlined()
                    ->icon('heroicon-o-paper-airplane')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Kirim Dokumen via WhatsApp')
                    ->modalDescription('Pastikan dokumen sudah di-approve. Sistem akan mengirimkan file PDF dari storage ke nomor WhatsApp mahasiswa.')
                    ->action(function ($record, Api $waApi) { // Inject Service Api.php
                        
                        // 1. Pastikan file sudah ada di database/storage
                        if (!$record->document_path) {
                            Notification::make()
                                ->title('Gagal Mengirim')
                                ->body('Path dokumen tidak ditemukan. Silahkan approve/generate dokumen terlebih dahulu.')
                                ->danger()
                                ->send();
                            return;
                        }

                        // 2. Persiapkan Data Pengiriman
                        $mahasiswa = $record->user; // Pastikan relasi 'user' ada di Model
                        $nomorWa = $mahasiswa->no_tlp; 
                        
                        // Memastikan nomor diawali dengan '+' sesuai format cURL yang Anda inginkan
                        // Jika di DB sudah ada '+', kita tidak perlu menambahkannya lagi
                        // 1. Hilangkan semua karakter non-angka (spasi, strip, dll)
                        $cleanPhone = preg_replace('/[^0-9]/', '', $nomorWa);

                        // 2. Cek dan ubah ke format +62
                        if (str_starts_with($cleanPhone, '0')) {
                            // Jika diawali 0, ganti 0 dengan +62
                            $formattedPhone = '+62' . substr($cleanPhone, 1);
                        } elseif (str_starts_with($cleanPhone, '62')) {
                            // Jika sudah 62, tinggal tambah +
                            $formattedPhone = '+' . $cleanPhone;
                        } else {
                            // Jika diawali angka lain (misal langsung 8), asumsikan butuh +62
                            $formattedPhone = '+62' . $cleanPhone;
                        }

                        // URL Publik (Expose link) agar Sidobe bisa mengambil file
                        $publicUrl = env('APP_URL') . '/storage/' . $record->document_path;
                        
                        // Nama file saat diterima di WA (mengambil nama asli dari path atau custom)
                        $fileNameDisplay = 'Surat_Izin_' . str_replace(' ', '_', $mahasiswa->name) . '.pdf';

                        $pesan = "Halo *{$mahasiswa->name}*,\n\n" .
                                "Berikut adalah dokumen *Surat Izin Penelitian* Anda yang telah selesai diproses.\n\n" .
                                "Silahkan simpan dokumen ini dengan baik.\n" .
                                "_Terima kasih._\n\n" .
                                "Salam Hangat dari FTIK UIN Sunan Kudus";
                        try {
                            // 3. Panggil Service Api.php (Metode sendDocument)
                            $response = $waApi->sendDocument(
                                $formattedPhone, 
                                $pesan, 
                                $publicUrl, 
                                $fileNameDisplay
                            );


                            if ($response) {
                                // Update status jika pengiriman berhasil (opsional)
                                $record->update(['status' => 'Selesai']);
                                
                                Notification::make()
                                    ->title('Berhasil Terkirim')
                                    ->body('Dokumen berhasil dikirim ke nomor ' . $formattedPhone)
                                    ->success()
                                    ->send();
                            } else {
                                Notification::make()
                                    ->title('Gagal Mengirim')
                                    ->body('Gagal mengirim dokumen ke nomor ' . $formattedPhone)
                                    ->danger()
                                    ->send();
                            }

                        } catch (\Exception $e) {
                            Notification::make()
                                ->title('Gagal Kirim WhatsApp')
                                ->body($e->getMessage())
                                ->danger()
                                ->persistent()
                                ->send();
                        }
                    })
                    ->visible(fn ($record) => $record->document_path !== null), // Hanya tampil jika file sudah ada
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
