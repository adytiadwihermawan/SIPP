<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Uploadtugas extends Model
{
    protected $table = 'uploadtugas';

    public $timestamps = false;

    protected $dates = ['waktu_submit'];

    protected $fillable = [
        'namafile_tugas',
        'id_materi',
        'id_praktikum',
        'id_user',
        'waktu_submit'
    ];

    public function grade() {
            return $this->belongsTo(Nilai::class);
        }
}

