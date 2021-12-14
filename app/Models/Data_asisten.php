<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_asisten extends Model
{
    protected $table = 'data_asisten';

    protected $fillable = [
        'id_user',
        'id_praktikum'
    ];

    public $timestamps = false;
}
