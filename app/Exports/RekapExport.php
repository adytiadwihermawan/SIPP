<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use App\Models\Proses_praktikum;
use App\Models\Praktikum;
use App\Models\Wadahpresensi;
use App\Models\Wadah_tugas;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class RekapExport implements FromView, ShouldAutoSize, WithColumnFormatting
{

    protected $id;

    function __construct($id) {
            $this->id = $id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        $absen = Wadahpresensi::select('wadahpresensi.id_praktikum', 'urutanpertemuan', 'wadahpresensi.id_wadah', 'id_user')
                            ->join('praktikum', 'wadahpresensi.id_praktikum', 'praktikum.id_praktikum')
                            ->leftjoin('presensi', 'wadahpresensi.id_wadah', 'presensi.id_wadah')
                            ->where('wadahpresensi.id_praktikum', $this->id)
                            ->get();

        $mk = Praktikum::where('id_praktikum', $this->id)->get();

        $pertemuan = Wadahpresensi::where('id_praktikum', $this->id)->select('urutanpertemuan')->get();

        $peserta = Proses_praktikum::join('users', 'proses_praktikum.id_user', 'users.id')
                                    ->select('nama_user', 'username', 'id_praktikum', 'id')
                                    ->where('id_praktikum', $this->id)
                                    ->where('id_status', 4)
                                    ->get();

        $course1 = Wadah_tugas::join('pertemuan', 'wadah_tugas.id_pertemuan', 'pertemuan.id_pertemuan')
                                ->where('id_praktikum', $this->id)
                                ->get();

        $cekid = Wadahpresensi::first();

        return view('export', compact('absen', 'mk', 'pertemuan', 'peserta', 'course1', 'cekid'));
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER,
        ];
    }

}
