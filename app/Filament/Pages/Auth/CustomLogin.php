<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Support\HtmlString;

class CustomLogin extends BaseLogin
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
                TextInput::make('login')
                    ->label('NIM/NIP')
                    ->required()
                    ->autocomplete()
                    ->autofocus(),
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ]);
    }

    /**
     * Menentukan apakah input yang dimasukkan adalah email atau username
     */
    protected function getCredentialsFromFormData(array $data): array
    {
        // Mengecek apakah format input valid sebagai email
        $login_type = filter_var($data['login'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        return [
            $login_type => $data['login'],
            'password'  => $data['password'],
        ];
    }
}
