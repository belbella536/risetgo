<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NoSurat extends Model
{
    protected $table = 'no_surats';
    protected $fillable = [
        'nomor',
        'is_active',
    ];

    public function surat_masuk()
    {
        return $this->hasMany(SuratMasuk::class);
    }
}
