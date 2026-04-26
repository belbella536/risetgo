<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 2. Daftarkan icon pengganti di sini
        FilamentIcon::register([
            // Icon saat sidebar terbuka (tombol untuk melipat)
            'panels::sidebar.collapse-button' => 'heroicon-o-bars-3-bottom-left',

            // Icon saat sidebar terlipat (tombol untuk membuka kembali)
            'panels::sidebar.expand-button'   => 'heroicon-o-bars-3-bottom-right',
        ]);

        // Memaksa HTTPS jika diakses melalui tunnel/ngrok/expose
    if (request()->header('x-forwarded-proto') === 'https') {
        URL::forceScheme('https');
    }
    }
}
