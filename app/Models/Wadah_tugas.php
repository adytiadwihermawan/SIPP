<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wadah_tugas extends Model
{
    protected $fillable = [
        'id_pertemuan',
        'judul_tugas',
        'file_tugas',
        'deskripsi'
    ];

    protected $table = 'wadah_tugas';

    public $timestamps = false;
    
}
