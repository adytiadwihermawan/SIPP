<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Proses_praktikum extends Model
{
    protected $fillable = [
        'id_user',
        'id_praktikum'
    ];

    protected $table = 'proses_praktikum';

    public $timestamps = false;
    
    public function praktikum()
    {
        return $this->belongsTo(Praktikum::class);
    }
}
