<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Fakultas;
use App\Models\Prodi;
use App\Models\NoSurat;

class PengajuanSurat extends Model
{
    protected $table = 'pengajuan_surats';
    protected $fillable = [
        'user_id',
        'fakultas_id',
        'prodi_id',
        'no_surat_id',
        'nomor_surat',
        'instansi_tujuan',
        'judul_skripsi',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'disposisi',
        'keterangan',
        'document_path',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function fakultas()
    {
        return $this->belongsTo(Fakultas::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function no_surat()
    {
        return $this->belongsTo(NoSurat::class);
    }
}
