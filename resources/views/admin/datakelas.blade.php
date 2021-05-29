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
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
					<i class="fa fa-edit"></i> Tambah Data Kelas</button>

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

				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Tambah Kelas Baru</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form action="addkelas" method="post">
					<div class="modal-body">
					
						@csrf
							<div class="form-group">
								<label for="">Nama Kelas</label>
								<input type="text" class="form-control" name="nama_praktikum" >
								<span style="color:red">@error('nama_praktikum') {{ $message }} @enderror</span>
							</div>
							
							<div class="form-group">
								<label for="">Tahun Ajaran</label>
								<input type="text" class="form-control" name="tahun_ajaran" >
								<span style="color:red">@error('tahun_ajaran') {{ $message }} @enderror</span>
							</div>
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Tambah Kelas</button>
					</div>
					</form>
					</div>
				</div>
				</div>
				<!-- end Modal -->
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
                            <a href="" title="Edit" class="btn btn-success btn-sm">
								<i class="fa fa-user-plus"></i>
							</a>
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