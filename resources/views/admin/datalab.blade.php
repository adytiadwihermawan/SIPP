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
			<table id="example1" class="table table-bordered table-striped">
				<thead>
					<tr style="text-align: center;">
					<th>No</th>
                    <th>Nama Laboratorium</th>
                    <th>Nama Kepala Laboratorium</th>
					<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$no = 1;
				?>
				@foreach ($lab as $item)
                    <tr>
						<td style="text-align: center;">{{ $no }}</td>
                        <td>{{ $item->nama_laboratorium }}</td>
                        <td>{{ $item->nama_user }}</td>
						<td style="text-align: center;">
							<a href="editlab/{{ $item->id_laboratorium }}" title="Edit" class="btn btn-success btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="deletelab/{{  $item->id_laboratorium }}" title="Delete" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this data ?')">
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
			{{ $lab->links() }}
@endsection