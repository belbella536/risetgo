<?php

namespace App\Filament\Resources\ApprovalSurats\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\Action;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Str;
use App\Models\DocumentSignature;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use setasign\Fpdi\Fpdi;
use App\Services\WhatsAppService;

class ApprovalSuratsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn (Builder $query) => $query
                ->where('disposisi', auth()->id())
                ->where('status', 'diajukan')
            )
            ->columns([
                TextColumn::make('No.')
                    ->label('No.')
                    ->rowIndex(),  
                TextColumn::make('no_surat.nomor')
                    ->label('Nomor Surat')
                    ->default('Proses')
                    ->color(fn ($state): string => $state === 'Proses' ? 'danger' : 'success')
                    ->badge()
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
                Action::make('Tolak')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->modalHeading('Tolak Pengajuan Surat')
                    ->modalDescription('Silakan berikan alasan penolakan di bawah ini.')
                    ->modalSubmitActionLabel('Ya, Tolak')
                    ->form([
                        \Filament\Forms\Components\Textarea::make('keterangan')
                            ->label('Alasan Penolakan')
                            ->placeholder('Contoh: Berkas tidak lengkap atau data tidak valid')
                            ->required(),
                    ])
                    ->action(function ($record, array $data) {
                        $record->update([
                            'status' => 'Tolak',
                            'keterangan' => $data['keterangan'],
                        ]);
                        
                        Notification::make()
                            ->title('Pengajuan ditolak')
                            ->danger()
                            ->send();
                    })
                    ->hidden(fn ($record) => in_array($record->status, ['Selesai', 'Tolak'])),
                
                Action::make('approve')
                    ->label('Approve & Tanda Tangani')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Approve & Tanda Tangani Surat')
                    ->modalDescription('Apakah Anda yakin ingin menyetujui pengajuan surat ini? Tindakan ini sekaligus akan menyematkan Tanda Tangan Elektronik (TTE) Anda yang sah pada dokumen.')
                    ->modalSubmitActionLabel('Ya, Approve & TTE')
                    ->action(function ($record, \App\Services\SaveDocument $service) { // Inject service di sini
                        
                        // 1. Catat TTE ke dalam database DocumentSignature
                        $tte = \App\Models\DocumentSignature::create([
                            'pengajuan_surat_id' => $record->id,
                            'user_id' => auth()->id(),
                            'verification_code' => \Illuminate\Support\Str::uuid(),
                            'signed_at' => now(),
                            'ip_address' => request()->ip(),
                        ]);

                        // 2. Generate PDF dan Simpan ke Storage menggunakan Service
                        // Pastikan panggil ini SETELAH buat TTE karena service butuh data TTE untuk QR Code
                        $filePath = $service->saveToStorage($record->id);

                        // 3. Ubah status pengajuan dan simpan path dokumen
                        $record->update([
                            'status' => 'Selesai',
                            'document_path' => $filePath // Simpan path ke kolom document_path
                        ]);

                        \Filament\Notifications\Notification::make()
                            ->title('Berhasil')
                            ->body('Surat telah ditandatangani dan diarsipkan.')
                            ->success()
                            ->send();
                    })
                    ->hidden(fn ($record) => $record->status === 'Selesai'),
                    
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}