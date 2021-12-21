@extends('asist.dashboard-mk')
@section('title', "Rekap Presensi")
@section('Judul', 'Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat')

@section('content')
@section('content')
<div class="card col-12 blue1">
        <div class="card-header">
            <h3 class="card-title">
                <b> {{$mk[0]->nama_praktikum}} </b>
            </h3>

        </div>
    </div>

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