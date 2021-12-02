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
    
    protected $primaryKey = 'id_pertemuan';

    public $timestamps = false;
    
}
