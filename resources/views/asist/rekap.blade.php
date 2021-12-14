@extends('asist.dashboard-mk')
@section('title', "Rekap Presensi")
@section('Judul', 'Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat')

@section('content')

 <table class="table table-striped hover" id="rekap-asist">
      <thead>
          <tr style="text-align: center">
              <th>No</th>
              <th>NAMA</th>
              <th>NIM</th>
              <th>KETERANGAN</th>
          </tr>
      </thead>
  </table>

@endsection