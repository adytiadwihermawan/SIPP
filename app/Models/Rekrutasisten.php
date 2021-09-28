<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekrutasisten extends Model
{
    protected $table = 'rekrutasisten';

    public $timestamps = false;

    protected $fillable = [
        'id_user',
        'praktikum_pilihan1',
        'IPK',
        'Nohp',
        'filetranskripnilai',
        'praktikum_pilihan2',
        'nilai_pilihan1',
        'nilai_pilihan2'
    ];
}
