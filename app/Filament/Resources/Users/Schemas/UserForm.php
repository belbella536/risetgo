<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Illuminate\Support\Facades\Hash;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('avatar_img')
                ->label('Foto Profil')
                ->image()
                ->avatar() // Menampilkan preview bulat
                ->directory('avatars') // Akan disimpan di storage/app/public/avatars
                ->visibility('public') // <- Tambahkan baris ini
                ->columnSpanFull(),

            TextInput::make('name')
                ->required()
                ->maxLength(255),

            TextInput::make('username')
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255),

            TextInput::make('email')
                ->email()
                ->required()
                ->unique(ignoreRecord: true)
                ->maxLength(255),

            Select::make('role')
                ->label('Hak Akses (Role)')
                ->options([
                    'admin' => 'Admin',
                    'pimpinan' => 'Pimpinan',
                    'mahasiswa' => 'Mahasiswa',
                ])
                ->required()
                ->native(false), // Opsional: membuat tampilan dropdown lebih modern

            TextInput::make('password')
                ->password()
                ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                ->dehydrated(fn ($state) => filled($state))
                ->required(fn (string $context): bool => $context === 'create'), // Wajib saat buat user baru, tidak wajib saat edit
        ]);
    }
}
