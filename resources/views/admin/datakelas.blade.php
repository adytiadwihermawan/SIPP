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
			<div>
				<button type="button" class="btn btn-primary" onclick="window.location.href='/tambahkelas'">
					<i class="fa fa-edit"></i> Tambah Kelas </button>
				
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
							
					<button type="button" class="btn btn-primary" onclick="window.location.href='/tambahpeserta'">
					<i class="fa fa-plus"></i> Peserta Kelas </button>
					<button type="button" class="btn btn-info" onclick="window.location.href='/tambahasisten'">
					<i class="fa fa-plus"></i> Asisten Kelas </button>
					
					<a href="editkelas/{{ $item->id_praktikum }}" title="Edit" class="btn btn-success btn">
								<i class="fa fa-edit"></i> Edit 
							</a>
							<a href="deletekelas/{{  $item->id_praktikum }}" title="Delete" class="btn btn-danger btn" onclick="return confirm('Are you sure to delete this data ?')">
								<i class="fa fa-trash"></i> Hapus
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