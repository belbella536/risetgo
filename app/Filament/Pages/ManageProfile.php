<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use App\Models\User;
use Filament\Schemas\Schema;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Hash;
use Filament\Actions\Action;

class ManageProfile extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $title = 'My Profile';
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-square-3-stack-3d';
    protected string $view = 'filament.pages.manage-profile';

    // 1. Properti $data INI WAJIB ADA untuk menampung inputan
    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill(
            auth()->user()->attributesToArray()
        );
    }

   public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make('Profile Information')
                    ->description('Perbarui informasi profil dan alamat email akun Anda.')
                    ->columns(3)
                    ->schema([

                        // --- BAGIAN KIRI: AVATAR (Mengambil 1 Kolom) ---
                        \Filament\Schemas\Components\Group::make()
                            ->schema([
                                FileUpload::make('avatar_img')
                                    ->label('Foto Profil')
                                    ->image()
                                    ->avatar() // Menampilkan preview bulat
                                    ->directory('avatars') // Akan disimpan di storage/app/public/avatars
                                    ->visibility('public') // <- Tambahkan baris ini
                                    ->columnSpanFull(),
                            ])
                            ->columnSpan(1), // Ambil jatah 1 kolom

                        // --- BAGIAN KANAN: DATA DIRI (Mengambil 2 Kolom) ---
                        \Filament\Schemas\Components\Group::make()
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama Lengkap')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('username')
                                    ->label('Username')
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(table: 'users', ignorable: auth()->user()),

                                TextInput::make('email')
                                    ->label('Email Address')
                                    ->email()
                                    ->required()
                                    ->maxLength(255)
                                    ->unique(table: 'users', ignorable: auth()->user()),

                                TextInput::make('no_tlp')
                                    ->label('Nomor Telepon')
                                    ->required()
                                    ->maxLength(255),

                                TextInput::make('password')
                                    ->label('Password Baru')
                                    ->password()
                                    ->revealable()
                                    ->maxLength(255)
                                    ->dehydrateStateUsing(fn (string $state): string => \Illuminate\Support\Facades\Hash::make($state))
                                    ->dehydrated(fn (?string $state): bool => filled($state))
                                    ->helperText('Kosongkan jika tidak ingin mengubah password.'),
                                TextInput::make('role')
                                    ->label('Role')
                                    ->disabled() // Menonaktifkan input role agar tidak bisa diubah
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->columns(2) // Inputan data diri dibuat 2 kolom berdampingan
                            ->columnSpan(2), // Ambil sisa jatah 2 kolom dari total 3 kolom
                    ]),
                    Action::make('Simpan Profil')
                        ->submit('save')
                        ->label('Simpan Profil')
                        ->icon('heroicon-o-check')
                        ->color('primary'),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();
        auth()->user()->update($data);

        Notification::make()
            ->success()
            ->title('Profile updated successfully')
            ->send();
    }
}
