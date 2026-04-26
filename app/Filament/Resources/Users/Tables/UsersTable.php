<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\DeleteAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->heading('Daftar Pengguna')
            ->description('Manage your users here.')
            ->columns([
                TextColumn::make('No.')
                    ->rowIndex(),
                ImageColumn::make('avatar_img')
                    ->label('Avatar')
                    ->circular(), // Membuat foto menjadi bulat di tabel

                TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('username')
                    ->searchable(),

                TextColumn::make('role')
                    ->sortable()
                    ->badge() // Menampilkan role seperti label (badge)
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',
                        'pimpinan' => 'warning',
                        'mahasiswa' => 'success',
                        default => 'gray',
                    }),

                TextColumn::make('email')
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
