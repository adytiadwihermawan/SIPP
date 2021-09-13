<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    protected $table = 'pertemuan';

    protected $fillable = [
        'nama_pertemuan',
        'deskripsi',
        'id_praktikum'
    ];

    public function pertemuan()
    {
        return $this->hasOne(Praktikum::class);
    }
}
