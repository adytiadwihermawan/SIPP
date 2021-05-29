@extends('admin.dashboard')
@section('title', "Data User")
@section('content')

<div class="card card-info">
	<div class="card-header">
		<h3 class="card-title">
			<i class="fa fa-table"></i> Data Pengguna</h3>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<div class="table-responsive">
			<div>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adduser">
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

				<!-- Modal -->
				<div class="modal fade" id="adduser" tabindex="-1" role="dialog" aria-labelledby="adduserLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="adduserLabel">Tambah Pengguna Baru</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form id="adduser" action="adduser" method="post">
					<div class="modal-body">
					
						@csrf
							<div class="form-group">
								<label for="">Nama</label>
								<input type="text" class="form-control" name="nama_user" value="{{ old('nama_user') }}">
								<span style="color:red">@error('nama_user') {{ $message }} @enderror</span>
							</div>
							
							<div class="form-group">
								<label for="">Id User</label>
								<input type="text" class="form-control" name="id" value="{{ old('id') }}">
								<span style="color:red">@error('id') {{ $message }} @enderror</span>
							</div>
							
							<div class="form-group">
								<label for="">Password</label>
								<input type="password" class="form-control" name="password" value="{{ old('password') }}">
								<span style="color:red">@error('password') {{ $message }} @enderror</span>
							</div>

							<div class="form-group">
								<label for="">Role</label>
								<select id="role" name="role" value="{{ old('role') }}">
									<option value="" selected></option>
									<option value="1">admin</option>
									<option value="2">dosen</option>
									<option value="3">asisten</option>
									<option value="4">mahasiswa</option>
								</select>
								<span style="color:red">@error('role') {{ $message }} @enderror</span>
							</div>
						
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Tambah User</button>
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
                    <th>Id User</th>
                    <th>Nama</th>
                    <th>Status</th>
					<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$no = 1;
				?>
				@foreach ($user as $item)
                    <tr>
						<td style="text-align: center;">{{ $no }}</td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->nama_user }}</td>
                        <td style="text-align: center;">{{ $item->status}}</td>
						<td style="text-align: center;">
							<a href="edit/{{ $item->id }}" title="Edit" class="btn btn-success btn-sm">
								<i class="fa fa-edit"></i>
							</a>
							<a href="delete/{{  $item->id }}" title="Delete" class="btn btn-danger btn-sm" onsubmit="return confirm('Hapus Data User ?')">
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
			{{ $user->links() }}
@endsection