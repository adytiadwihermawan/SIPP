<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // dd($row);
            $user = User::where('username', $row['nimnip'])->first();
            if(is_null($user)){
                User::insert([    
                'nama_user' => $row['nama'],
                'username' => $row['nimnip'],
                'password' => Hash::make($row['password']),
                'id_status' => $row['role']
                ]);
            }
    }
}
