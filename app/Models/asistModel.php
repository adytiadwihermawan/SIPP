<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class asistModel extends Model
{
    public function asistenuser()
    {
        return DB::table('users')
        ->leftJoin('status_user', 'status_user.id_status', '=', 'users.id_status')->get();
    }
}
