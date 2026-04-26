<?php

namespace App\Filament\Resources\PimpinanSettings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;

class PimpinanSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->label('Nama Pimpinan'),

                TextColumn::make('nip')
                    ->label('NIP')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('jabatan')
                    ->label('Jabatan')
                    ->searchable()
                    ->sortable(),

            ImageColumn::make('tanda_tangan_path')
                ->label('Tanda Tangan')
                ->disk('public') // Pastikan sesuai dengan disk storage Anda
                ->circular()
                ->defaultImageUrl(url('/placeholder-ttd.png')) // Placeholder jika tidak ada
                ->width(100),

            ToggleColumn::make('is_active')
                ->label('Status')
                ->onColor('success')
                ->offColor('danger'),

            TextColumn::make('created_at')
                ->label('Dibuat Pada')
                ->dateTime('d F Y H:i')
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->button()
                    ->outlined()
                    ->label(' '),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
