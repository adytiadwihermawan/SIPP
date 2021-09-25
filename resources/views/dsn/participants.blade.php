@extends('dsn.dashboard-mk')
@section('title', "Partisipan Kelas")
@section('Judul', 'Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat')

@section('content')        

<div class="card blue1 ml-3">
        <div class="card-header">
            <h3 class="card-title">
              <b>  {{$mk[0]->nama_praktikum}} </b>
            </h3>

        </div>
    </div>


<div class="card card-outline card-warning ml-3 py-4 px-4">
<table style="width: 100%" class="table table-bordered table-striped my-5" id="partisipan">
            <thead>
                <tr style="text-align: center">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
</table>
</div>
@endsection