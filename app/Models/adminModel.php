<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class adminModel extends Model
{
  public function Datakelas()
  {
     return DB::table('praktikum')->simplePaginate(5);
  }

  public function Datalab()
  {
      return DB::table('lab')
      ->leftJoin('users', 'users.id', '=', 'lab.id_kepalalaboratorium')
      ->simplePaginate(5);
  }

  public function Datauserlab()
  {
    return DB::table('users')
    ->leftJoin('lab', 'lab.id_kepalalaboratorium', '=', 'users.id')
    ->where('users.id_status', 2)
        ->get();
  }

  public function Editdata()
  {
    return DB::table('status_user')
    ->get();
  }


}
