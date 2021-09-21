<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uploadtugas extends Model
{
    protected $table = 'uploadtugas';

    protected $fillable = [
        'namafile_tugas',
        'id_materi',
        'id_praktikum',
        'id_user'
    ];
}
