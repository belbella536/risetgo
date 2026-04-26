<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Register as BaseRegister; // Namespace baru di Filament v4
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema; // Menggunakan Schema untuk Filament v4
use Illuminate\Support\HtmlString;

class CustomRegister extends BaseRegister
{
    public function getHeading(): string
    {
        return 'Riset Go';
    }

    public function getSubheading(): HtmlString
    {
        // 1. Ambil link Sign up bawaan dari Filament
        $signUpLink = parent::getSubheading();

        // 2. Kembalikan teks Fakultas digabung dengan link Sign Up menggunakan HTML
        return new HtmlString(
            'Fakultas Tarbiyah dan Ilmu Keguruan' . '<br><br>' . $signUpLink
        );
    }

    public function form(Schema $schema): Schema
    {
        return $schema
            ->schema([
                $this->getNameFormComponent(),
                TextInput::make('username')
                    ->label('NIM/NIP')
                    ->required()
                    ->maxLength(255)
                    ->unique($this->getUserModel()),
                TextInput::make('no_tlp')
                    ->label('Nomor Telepon')
                    ->required()
                    ->maxLength(20),
                $this->getEmailFormComponent(),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),
            ]);
    }
}
