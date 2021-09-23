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
        $row['id'] = $user->id;
        $row['id_praktikum'] = $kelas->id_praktikum;
        return new Proses_praktikum([
            'id_user' => $row['id'],
            'id_praktikum' => $row['id_praktikum']
        ]);
    }
}
