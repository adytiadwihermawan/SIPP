<?php

namespace App\Imports;

use App\Models\Proses_praktikum;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\User;
use App\Models\Praktikum;

class PesertaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $user = User::where("username", "like", "%".$row[0]."%")->first();
        $kelas = Praktikum::where("nama_praktikum", "like", "%".$row[1]."%")->first();

        // dd($row);
        $cekuser = $row['id'] = $user->id;
        $cekpraktikum = $row['id_praktikum'] = $kelas->id_praktikum;

        $cek = Proses_praktikum::where("id_user", "like", "%".$cekuser."%")
                                ->where("id_praktikum", "like", "%".$cekpraktikum."%")
                                ->first();
        if(is_null($cek)){
                Proses_praktikum::insert([    
                'id_user' => $cekuser,
                'id_praktikum' => $cekpraktikum
                ]);
            }
    }
}
