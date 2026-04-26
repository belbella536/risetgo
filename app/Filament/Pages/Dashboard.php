<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    // Kita samakan tipe datanya persis seperti yang diminta oleh pesan error
    protected static string | \BackedEnum | null $navigationIcon = 'heroicon-o-square-3-stack-3d';
}