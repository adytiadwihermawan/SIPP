@extends('admin.dashboard')

@section('Judul', "Sistem Informasi Pendataan Praktikum Teknologi Informasi Universitas Lambung Mangkurat")
@section('title', "Data Lab")
@section('content')

<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Laboratorium</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<button type="button" class="btn btn-primary" onclick="window.location.href='/tambahlab'">
					<i class="fa fa-edit"></i> Tambah Data</button>

					@if(Session::get('berhasil'))
					<hr>
					<div class="alert alert-success">
						{{ Session::get('berhasil')  }}
					</div>
					@endif

					@if(Session::get('gagal'))
					<hr>
						<div class="alert alert-danger">
							{{ Session::get('gagal')  }}
						</div>
					@endif
			</div>
			<br>
			<table id="datalab" class="table table-bordered table-striped">
				<thead>
					<tr style="text-align: center;">
					<th>NO</th>
                    <th>NAMA LABORATORIUM</th>
                    <th>NAMA KEPALA LABORATORIUM</th>
					<th>AKSI</th>
					</tr>
				</thead>
			</table>
@endsection