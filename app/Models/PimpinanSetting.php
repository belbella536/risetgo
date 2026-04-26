<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PimpinanSetting extends Model
{
    protected $fillable = [
        'user_id',
        'nip',
        'jabatan',
        'tanda_tangan_path',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}