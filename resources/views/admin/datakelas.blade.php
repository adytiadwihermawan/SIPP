@extends('admin.dashboard')
@section('title', "Data Kelas")
@section('content')

<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Kelas</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			
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
			<button type="button" class="btn btn-primary" onclick="window.location.href='/tambahkelas'">
				<i class="fa fa-edit"></i> Tambah Kelas </button>
			<button type="button" class="btn btn-primary" onclick="window.location.href='/tambahpeserta'">
				<i class="fa fa-user-plus"></i> Tambah Peserta Kelas </button>
			<br>
			<br>
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr style="text-align: center;">
					<th>No</th>
                    <th>Id Kelas</th>
                    <th>Nama Kelas</th>
                    <th>Tahun Ajaran</th>
					<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$no = 1;
				?>
				@foreach ($kelas as $item)
                    <tr>
						<td style="text-align: center;">{{ $no }}</td>
                        <td>{{ $item->id_praktikum }}</td>
                        <td>{{ $item->nama_praktikum }}</td>
                        <td style="text-align: center;">{{ $item->tahun_ajaran}}</td>
						<td style="text-align: center;">
							<a href="edit/{{ $item->id_praktikum }}" title="Edit" class="btn btn-success btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="delete/{{  $item->nama_praktikum }}" title="Delete" class="btn btn-danger btn-sm">
								<i class="fa fa-trash"></i>
							</a>
						</td>
                    </tr>
				<?php
					$no++;
				?>
                </tbody>
                @endforeach
			</table>
			{{ $kelas->links() }}
@endsection