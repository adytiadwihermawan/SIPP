@extends('dsn.dashboard-mk')
@section('title', "Data Presensi")
@section('Judul', 'Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat')

@section('content')
<div class="card col-12 blue1">
        <div class="card-header">
            <h3 class="card-title">
                <b>Data Presensi Praktikum {{$mk[0]->nama_praktikum}} </b>
            </h3>

        </div>
    </div>
 <table class="table table-striped hover" style="width: 95%!important" id="export">
      <thead>
          <tr style="text-align: center">
              <th>No</th>
              <th>NAMA</th>
              <th>NIM</th>
              @foreach ($pertemuan as $item)
              <th>PERTEMUAN {{$item->urutanpertemuan}}</th>
              @endforeach
          </tr>
      </thead>
  </table>

@endsection