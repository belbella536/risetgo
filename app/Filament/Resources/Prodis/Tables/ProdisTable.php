<?php

namespace App\Filament\Resources\Prodis\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class ProdisTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->heading('Daftar Prodi')
            ->description('Manage your prodi here.')
            ->columns([
                TextColumn::make('No.')
                    ->rowIndex(),
                TextColumn::make('nama_prodi')
                    ->searchable()
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
