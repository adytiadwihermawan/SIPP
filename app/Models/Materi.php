<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cohensive\Embed\Facades\Embed;

class Materi extends Model
{
    protected $table = 'materi';
    protected $fillable = [
        'namafile_materi',
        'id_pertemuan'
    ];

    public $timestamps = false;
}

