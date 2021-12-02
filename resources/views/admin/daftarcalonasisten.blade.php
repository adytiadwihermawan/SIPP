@extends('admin.dashboard')
@section('title', "Daftar Calon Asisten")
@section('Judul', "Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat")

@section('content')
<div class="card card-info">
    
    <table style="width: 85%" class="table table-striped hover" id="viewcalonasisten">
        <thead>
            <tr style="text-align: center">
                <th>NO</th>
                <th>NAMA</th>
                <th>PRAKTIKUM PILIHAN 1</th>
                <th>NILAI PRAKTIKUM PILIHAN 1</th>
                <th>PRAKTIKUM PILIHAN 2</th>
                <th>NILAI PRAKTIKUM PILIHAN 2</th>
                <th>IPK</th>
                <th>NOMOR HP</th>
                <th>TRANSKRIP NILAI</th>
            </tr>
        </thead>
    </table>
</div>
<a class="btn blue4h btn-lg float-right" href="openrekrutasist"> Kembali </a>
@endsection
