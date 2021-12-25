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
        $pertemuan = Wadahpresensi::where('id_praktikum', $this->id)->pluck('id_wadah');

        //  $cek1 = "PERTEMUAN " .$pertemuan;
        // foreach ($pertemuan as $value => $item) {
        //     $cek = "PERTEMUAN " .$item->urutanpertemuan;
        // }
        return [
                'NO',
                'NAMA',
                'NIM',
                'PERTEMUAN 1',
                'PERTEMUAN 2',
                'PERTEMUAN 3',
                'PERTEMUAN 4',
                'PERTEMUAN 5',
                'PERTEMUAN 6',
                'PERTEMUAN 7',
                'PERTEMUAN 8',
                'PERTEMUAN 9',
                'PERTEMUAN 10',
                'PERTEMUAN 11',
                'PERTEMUAN 12',
                'PERTEMUAN 13',
                'PERTEMUAN 14',
                'PERTEMUAN 15',
                'PERTEMUAN 16',
            ];
        
        // return [
        //     'NO',
        //     'NAMA',
        //     $cek,
        // ];
    }
}
