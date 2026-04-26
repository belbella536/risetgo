<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pengajuan_surats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('fakultas_id')->constrained()->cascadeOnDelete();
            $table->foreignId('prodi_id')->constrained()->cascadeOnDelete();
            $table->foreignId('no_surat_id')->nullable()->constrained()->nullOnDelete();
            $table->string('nomor_surat')->nullable();
            $table->string('instansi_tujuan');
            $table->text('judul_skripsi');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('status')->default('diajukan');
            $table->string('disposisi')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_surats');
    }
};
