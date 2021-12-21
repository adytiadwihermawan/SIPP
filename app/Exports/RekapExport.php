<?php

namespace App\Exports;

use App\Models\Presensi;
use Maatwebsite\Excel\Concerns\FromCollection;

class RekapExport implements FromCollection
{

    protected $id;

    function __construct($id) {
            $this->id_praktikum = $id;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Presensi::all();
    }
}
