<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Praktikum extends Model
{
    protected $table = 'praktikum';

    public function praktikum()
    {
        return $this->hasManyThrough(Praktikum::class, Pertemuan::class);
    }
}
