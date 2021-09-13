<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Praktikum extends Model
{
    protected $table = 'praktikum';
    
    public $timestamps = false;
    
    protected $fillable = [
        'id_praktikum', 'tahun_ajaran', 'nama_praktikum'
    ];
    
}
