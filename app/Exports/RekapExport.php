<?php

namespace App\Exports;

use App\Models\Presensi;
use App\Models\Wadahpresensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RekapExport implements FromCollection, WithHeadings
{

    protected $id;

    function __construct($id) {
            $this->id = $id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {

        $cek = Wadahpresensi::Join('presensi', function($join){
                        $join->on('presensi.id_wadah', '=', 'wadahpresensi.id_wadah');
                        $join->where('wadahpresensi.id_praktikum', $this->id);
                    })
                    ->rightjoin('users', function($join){
                        $join->on('users.id', '=', 'presensi.id_user');
                    })
                    ->Join('proses_praktikum', function($join){
                        $join->on('proses_praktikum.id_user', '=', 'users.id');
                        $join->where('proses_praktikum.id_praktikum', $this->id);
                    })
                    ->where('id_status', 4)
                    ->get();

        return $cek;
    }

    public function headings(): array
    {
        $pertemuan = Wadahpresensi::where('id_praktikum', $this->id)->select('urutanpertemuan')->get();

         $cek1 = "PERTEMUAN " .$pertemuan;
        foreach ($pertemuan as $value => $item) {
            $cek = "PERTEMUAN " .$item->urutanpertemuan;

            return [
                'NO',
                'NAMA',
                'NIM',
                $cek
            ];
        }
        
        // return [
        //     'NO',
        //     'NAMA',
        //     $cek,
        // ];
    }
}
