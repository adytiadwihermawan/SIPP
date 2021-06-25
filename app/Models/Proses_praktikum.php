<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Proses_praktikum extends Model
{
    protected $table = 'proses_praktikum';
    
    public function praktikum()
    {
        return $this->belongsTo('App\Praktikum');
    }
    public function peserta()
    {
        return $this->belongsTo('App\User');
    }
}
