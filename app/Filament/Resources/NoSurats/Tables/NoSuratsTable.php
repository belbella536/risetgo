<?php

namespace App\Filament\Resources\NoSurats\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class NoSuratsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->heading('Daftar Nomor Surat')
            ->description('Manage your nomor surat here.')
            ->columns([
                TextColumn::make('No.')
                    ->rowIndex(),
                TextColumn::make('nomor')
                    ->label('Nomor Surat')
                    ->searchable()
                    ->sortable(),
                ToggleColumn::make('is_active')
                    ->label('Status')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->button()
                    ->outlined()
                    ->label(' '),
                DeleteAction::make()
                    ->button()
                    ->outlined()
                    ->icon('heroicon-o-trash')
                    ->color('danger')
                    ->label(' '),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
