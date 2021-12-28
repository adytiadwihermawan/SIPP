<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Wadahpresensi extends Model
{
    protected $fillable = [
        'id_praktikum',
        'keterangan',
        'waktu_mulai',
        'waktu_berakhir',
        'tanggal',
        'urutanpertemuan'
    ];

    protected $dates = [
        'waktu_mulai',
        'waktu_berakhir',
        'tanggal'
    ];

    public $timestamps = false;

    protected $table = 'wadahpresensi';

    protected  $primaryKey = 'id_wadah';
    
    public function wadahpresensi(){
    	return $this->hasMany(Presensi::class, 'id_wadah', 'id_wadah');
    }


}
