<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fakultas extends Model
{
    protected $table = 'fakultas';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_fakultas',
    ];
}
