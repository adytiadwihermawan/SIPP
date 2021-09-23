@extends('mhs.dashboard-mk')
@section('title', "Partisipan Kelas")
@section('Judul', 'Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat')

@section('content')    
<div class="card card-outline card-warning ml-3 py-4 px-4">
<table style="width: 90%" id="partis"  id="example1" class="table table-bordered table-striped my-5">
            <thead>
                <tr style="text-align: center" class="tomato">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Role</th>
                </tr>
            </thead>
</table>
</div>

@endsection