<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
            $user = User::where('username', $row[1])->first();
            if(is_null($user)){
                User::insert([    
                'nama_user' => $row[0],
                'username' => $row[1],
                'password' => Hash::make($row[2]),
                'id_status' => $row[3]
                ]);
            }
    }
}
