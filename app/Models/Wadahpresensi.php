<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wadahpresensi extends Model
{
    protected $fillable = [
        'id_pertemuan',
        'urutanpertemuan',
        'keterangan',
        'waktu_mulai',
        'waktu_berakhir'
    ];

    protected $table = 'wadahpresensi';
    
}
