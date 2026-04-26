<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CetakSuratController;
use App\Models\DocumentSignature;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/cetak-surat/{id}', [CetakSuratController::class, 'cetak'])->name('cetak.surat');
});

Route::get('/verifikasi-surat/{code}', function ($code) {
    // Cari data TTE berdasarkan UUID
    $signature = DocumentSignature::with(['pengajuanSurat.mahasiswa', 'user'])
                    ->where('verification_code', $code)
                    ->firstOrFail(); // Jika kode asal-asalan, otomatis 404

    return view('verifikasi-surat', compact('signature'));
});