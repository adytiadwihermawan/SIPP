@extends('admin.dashboard')
@section('title', "Rekap Asisten")
@section('Judul', "Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat")

@section('content')
<div class="card card-info">
    
    <table style="width: 85%" class="table table-striped hover" id="rekapasisten">
        <thead>
            <tr style="text-align: center">
                <th>NO</th>
                <th>NAMA</th>
                <th>NIM</th>
                <th>ASISTEN PRAKTIKUM</th>
                <th>TAHUN AJARAN</th>
                <th>SERTIFIKAT</th>
            </tr>
        </thead>
    </table>
</div>
<a class="btn blue4h btn-lg float-right" href="openrekrutasist"> Kembali </a>
@endsection
