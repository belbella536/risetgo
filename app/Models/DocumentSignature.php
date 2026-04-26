<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentSignature extends Model
{
    protected $fillable = [
        'pengajuan_surat_id',
        'user_id',
        'verification_code',
        'signed_at',
        'ip_address',
    ];

    // Karena tipe datanya tanggal, kita cast ke datetime
    protected $casts = [
        'signed_at' => 'datetime',
    ];

    public function pengajuanSurat()
    {
        return $this->belongsTo(PengajuanSurat::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}