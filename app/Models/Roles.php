<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $fillable = [
        'id_user',
        'id_status',
        'id_praktikum'
    ];

    protected $table = 'roles';
}
