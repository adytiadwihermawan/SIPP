<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wadah_tugas extends Model
{
    protected $fillable = [
        'id_pertemuan',
        'url',
        'judul_tugas',
        'file_tugas',
        'deskripsi', 
        'waktu_mulai',
        'waktu_selesai',
        'waktu_cutoff'
    ];

    protected $table = 'wadah_tugas';

    protected $dates = ['waktu_mulai', 'waktu_selesai', 'waktu_cutoff'];

    public $timestamps = false;
    
}
