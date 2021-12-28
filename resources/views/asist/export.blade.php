@extends('asist.dashboard-mk')
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
 <table class="table table-striped hover">
      <thead>
          <tr style="text-align: center">
              <th>No</th>
              <th>NAMA</th>
              <th>NIM</th>
              @foreach ($pertemuan as $item)
              <th>PERTEMUAN {{$item->urutanpertemuan}}</th>
              @endforeach
              <th style="text-align: center">TOTAL HADIR</th>
              <th style="text-align: center">TOTAL TANPA KETERANGAN</th>
          </tr>
      </thead>
      <tbody>
              @foreach ($peserta as $user)
          <tr>
              <td style="text-align: center">{{ $loop->iteration }}</td>
              <td>{{ $user->nama_user }}</td>
              <td style="text-align: center">{{ $user->username }}</td>
              <?php 
                $count = 0;
                $count2 = 0;
              ?>
              @foreach ($absen as $cek)
              @if ($user->id == $cek->id_user)
              <td style="text-align: center">1<?php $count++; ?></td>
              @else
              <td style="text-align: center">0<?php $count2++; ?></td>   
              @endif
              @endforeach
              <td style="text-align: center">{{$count}}</td>
              <td style="text-align: center">{{$count2}}</td>
          </tr>
              @endforeach
      </tbody>
  </table>
@endsection